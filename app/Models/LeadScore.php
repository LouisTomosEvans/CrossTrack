<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyLeads;

class LeadScore extends Model
{
    use HasFactory;

    public function companyLead()
    {
        return $this->belongsTo(CompanyLeads::class);
    }

    public function calculateScore()
    {
        // Define weights for each factor
        $weights = [
            'unique_visitors' => 1,
            'total_page_views' => 0.5,
            'total_time_spent' => 0.001,
            'interactions' => 0.125,
            'high_value_page_views' => 1,
            'high_value_time_spent' => 0.002,
            'high_value_interactions' => 0.25,
            // Add other factors and weights as needed
        ];

        // Retrieve the total time spent on pages and interaction count for the CompanyLead
        // Adjust the queries according to your data structure and relationships
        $unique_visitors = $this->companyLead->visits->unique('visitor_id')->count();
        $total_time_spent = $this->companyLead->visits->sum('session_duration');
        $interaction_count = $this->companyLead->visits->where('interaction', '=', 'click')->count();
        $total_page_views = $this->companyLead->visits->unique('title')->count();
        // contact, pricing, demo
        $high_value_page_views = $this->companyLead->visits->where('title', 'LIKE', '%contact%')->orWhere('title', 'LIKE', '%pricing%')->orWhere('title', 'LIKE', '%demo%')->where('interaction', '=', 'load')->count();
        $high_value_time_spent = $this->companyLead->visits->where('title', 'LIKE', '%contact%')->orWhere('title', 'LIKE', '%pricing%')->orWhere('title', 'LIKE', '%demo%')->sum('session_duration');
        $high_value_interactions = $this->companyLead->visits->where('title', 'LIKE', '%contact%')->orWhere('title', 'LIKE', '%pricing%')->orWhere('title', 'LIKE', '%demo%')->where('interaction', '=', 'click')->count();


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
        $maxTimeSpent = 500;
        $maxInteractionCount = 10;
        $maxHighValuePageViews = 2;
        $maxHighValueTimeSpent = 180;
        $maxHighValueInteractionCount = 5;

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
        $this->score = $score;
        $this->save();
    }
}


