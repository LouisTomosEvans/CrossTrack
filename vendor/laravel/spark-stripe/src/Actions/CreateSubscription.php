<?php

namespace Spark\Actions;

use Laravel\Cashier\SubscriptionBuilder;
use Spark\Concerns\HandlesPaymentFailures;
use Spark\Contracts\Actions\CreatesSubscriptions;
use Spark\Events\SubscriptionCreated;
use Spark\Spark;
use Stripe\Subscription;

class CreateSubscription implements CreatesSubscriptions
{
    use HandlesPaymentFailures;

    /**
     * {@inheritDoc}
     */
    public function create($billable, $plan, array $options = [])
    {
        $type = $billable->sparkConfiguration('type');

        $planObject = Spark::plans($type)
            ->where('id', $plan)
            ->first();

        $this->purgeOldSubscriptions($billable);

        $builder = $billable->newSubscription('default', $plan);

        $this->configureTrial($billable, $planObject, $builder);

        if (isset($options['coupon']) && $options['coupon']) {
            $this->applyCoupon($options['coupon'], $billable, $builder);
        }

        if (Spark::chargesPerSeat($type)) {
            $builder->quantity(Spark::seatCount($type, $billable));
        }

        $subscription = $this->createSubscriptionViaStripe($builder);

        if ($subscription &&
            ($subscription->onTrial() || $subscription->active())) {
            event(new SubscriptionCreated($billable));

            $billable->update(['trial_ends_at' => null]);
        }
    }

    /**
     * Actually create the subscription via Stripe.
     *
     * @param  \Laravel\Cashier\SubscriptionBuilder  $builder
     * @return \Laravel\Cashier\Subscription
     */
    protected function createSubscriptionViaStripe($builder)
    {
        return $this->attemptPayment(fn () => $builder->create());
    }

    /**
     * Cancel and delete any old subscriptions except ones that were already cancelled.
     *
     * @param  \Spark\Billable  $billable
     * @return void
     */
    protected function purgeOldSubscriptions($billable)
    {
        $billable->subscriptions()->where('stripe_status', '!=', Subscription::STATUS_CANCELED)
            ->each(function ($subscription) {
                try {
                    $status = $subscription->stripe_status;

                    $subscription->noProrate();

                    $subscription->cancelNow();

                    if ($status === Subscription::STATUS_INCOMPLETE_EXPIRED) {
                        $subscription->items()->delete();
                        $subscription->delete();
                    }
                } catch (\Throwable $e) {
                }
            });
    }

    /**
     * Configure the trial period.
     *
     * @param  \Spark\Billable  $billable
     * @param  \Spark\Plan  $plan
     * @param  \Laravel\Cashier\SubscriptionBuilder  $builder
     * @return void
     */
    protected function configureTrial($billable, $plan, $builder)
    {
        $skipTrialIfSubscribedBefore = config('spark.skip_trial_if_subscribed_before');

        if (is_null($skipTrialIfSubscribedBefore) ||
            ! $subscription = $billable->subscription()) {
            $plan->trialDays ? $builder->trialDays($plan->trialDays) : null;

            return;
        }

        if (now()->diffInDays($subscription->ends_at) < $skipTrialIfSubscribedBefore) {
            $builder->skipTrial();

            return;
        }

        $plan->trialDays ? $builder->trialDays($plan->trialDays) : null;
    }

    /**
     * Apply the coupon or promocode.
     *
     * @param  string  $coupon
     * @param  \Spark\Billable  $billable
     * @param  \Laravel\Cashier\SubscriptionBuilder  $builder
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    protected function applyCoupon($coupon, $billable, SubscriptionBuilder $builder): void
    {
        $codes = $billable->stripe()->promotionCodes->all(['code' => $coupon]);

        if ($codes && $codes->first()) {
            $builder->withPromotionCode($codes->first()->id);
        } else {
            $builder->withCoupon($coupon);
        }
    }
}
