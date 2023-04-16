<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\CompanyLeads;
use App\Models\Segmentation;

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

    public function companyLeads()
    {
        return $this->hasMany(CompanyLeads::class);
    }

    public function segmentations()
    {
        return $this->hasMany(Segmentation::class);
    }
}
