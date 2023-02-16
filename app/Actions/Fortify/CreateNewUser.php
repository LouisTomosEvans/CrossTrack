<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Models\Invite;
use App\Models\Team;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'invite' => ['sometimes', 'nullable'],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        if (isset($input['invite'])) {
            $invite = Invite::where('accept_token', $input['invite'])->first();
            if ($invite) {
                $user->current_team_id = $invite->team_id;
                $user->save();
                $user->attachTeam($invite->team);
                $invite->delete();
                // redirect to dashboard
                return $user;
            } else {
                // redirect to login with error
                return redirect()->route('login')->withErrors(['invite' => 'Invalid invite token']);
            }
        } else {
            $team = Team::create([
                'name' => $input['name'],
                'owner_id' => $user->id,
            ]);

            $user->current_team_id = $team->id;
            $user->save();

            $user->attachTeam($team);
        }

        return $user;
    }
}
