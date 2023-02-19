<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active',
        'team_id',
        'tracking_code',
        'tracking_status',
        'favicon',
        'domain',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
