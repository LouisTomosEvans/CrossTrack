<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;

class TeamIntegrationSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'integration_type',
        'api_key',
        'access_token',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
