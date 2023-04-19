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
            'interactions' => 0.2,
            'high_value_page_views' => 1,
            'high_value_time_spent' => 0.002,
            'high_value_interactions' => 0.4,
            // Add other factors and weights as needed
        ];

        // Retrieve the total time spent on pages and interaction count for the CompanyLead
        // Adjust the queries according to your data structure and relationships
        $totalTimeSpent = $this->companyLead->visits->sum('session_duration');
        $interactionCount = $this->companyLead->visits->where('interaction', '=', 'click')->count();

        // Calculate the raw lead score using the weights and the stored values
        $rawScore = (
            $this->unique_visitors * $weights['unique_visitors'] +
            $this->total_page_views * $weights['total_page_views'] +
            ($totalTimeSpent / 60) * $weights['total_time_spent'] +
            $interactionCount * $weights['interactions'] +
            $this->high_value_page_views * $weights['high_value_page_views'] +
            ($this->high_value_time_spent / 60) * $weights['high_value_time_spent'] +
            $this->high_value_interactions * $weights['high_value_interactions']
        );

        // Determine the maximum possible raw score based on the maximum values of each factor
        // Replace the maximum values with the maximum values you expect for each factor
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


