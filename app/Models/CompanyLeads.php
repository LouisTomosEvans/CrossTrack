<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use App\Models\Website;
use App\Models\Visits;
use App\Models\Note;
use App\Models\User;
use App\Models\LeadScore;


class CompanyLeads extends Model
{
    use HasFactory;
    use HasTags;

    protected $fillable = [
        'name',
        'size',
        'type',
        'industry',
        'latitude',
        'longitude',
        'domain',
        'phone',
        'email',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'description',
        'logo',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'youtube_url',
        'tiktok_url',
        'website_id',
        'timezone',
        'timezone_offset',
        'local_time',
        'interaction',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function visits()
    {
        return $this->hasMany(Visits::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'lead_user');
    }

    public function leadScore()
    {
        return $this->hasOne(LeadScore::class);
    }

    public function calculateScore()
    {
        // Define weights for each factor
        $weights = [
            'unique_visitors' => 1,
            'total_page_views' => 0.5,
            'total_time_spent' => 0.001,
            'interactions' => 0.125,
            'high_value_page_views' => 2,
            'high_value_time_spent' => 0.004,
            'high_value_interactions' => 2,
            // Add other factors and weights as needed
        ];

        // Retrieve the total time spent on pages and interaction count for the CompanyLead
        // Adjust the queries according to your data structure and relationships
        $unique_visitors = $this->visits->unique('visitor_id')->count();
        $total_time_spent = $this->visits->sum('session_duration');
        $interaction_count = $this->visits->where('interaction', '=', 'click')->count();
        $total_page_views = $this->visits->unique('title')->count();
        // contact, pricing, demo
        $high_value_page_views = $this->visits->where(function ($query) {$query->where('title', 'LIKE', '%contact%')->orWhere('title', 'LIKE', '%pricing%')->orWhere('title', 'LIKE', '%demo%');})->where('interaction', '=', 'load')->count();
        $high_value_time_spent = $this->visits->where(function ($query) {$query->where('title', 'LIKE', '%contact%')->orWhere('title', 'LIKE', '%pricing%')->orWhere('title', 'LIKE', '%demo%');})->sum('session_duration');
        $high_value_interactions = $this->visits->where(function ($query) {$query->where('title', 'LIKE', '%contact%')->orWhere('title', 'LIKE', '%pricing%')->orWhere('title', 'LIKE', '%demo%');})->where('interaction', '=', 'click')->count();

        // Calculate the raw lead score using the weights and the stored values
        $rawScore = (
            $unique_visitors * $weights['unique_visitors'] +
            $total_page_views * $weights['total_page_views'] +
            ($total_time_spent / 60) * $weights['total_time_spent'] +
            $interaction_count * $weights['interactions'] +
            $high_value_page_views * $weights['high_value_page_views'] +
            ($high_value_time_spent / 60) * $weights['high_value_time_spent'] +
            $high_value_interactions * $weights['high_value_interactions']
        );

        // Determine the maximum possible raw score based on the maximum values of each factor
        // Replace the maximum values with the maximum values you expect for each factor
        $maxUniqueVisitors = 2;
        $maxTotalPageViews = 4;
        $maxTimeSpent = 300;
        $maxInteractionCount = 5;
        $maxHighValuePageViews = 1;
        $maxHighValueTimeSpent = 120;
        $maxHighValueInteractionCount = 1;

        $maxRawScore = (
            $maxUniqueVisitors * $weights['unique_visitors'] +
            $maxTotalPageViews * $weights['total_page_views'] +
            ($maxTimeSpent / 60) * $weights['total_time_spent'] +
            $maxInteractionCount * $weights['interactions']
            // Include other factors in the calculation as needed
        );

        // Normalize the raw score to a range of 0-100
        $score = ($rawScore / $maxRawScore) * 100;

        // Make sure the score is within the 0-100 range (in case of any discrepancies)
        $score = max(0, min($score, 100));

        // Update the score in the database
        $this->leadScore()->updateOrCreate(
            ['company_leads_id' => $this->id],
            ['score' => $score]
        );
    }

}
