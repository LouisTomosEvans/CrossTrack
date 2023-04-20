<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Visits extends Model
{
    use HasFactory;

    protected $fillable = [
        'timestamp',
        'visitor_id',
        'company_leads_id',
        'referrer',
        'url',
        'title',
        'ip_address',
        'session_duration',
        'query_string_params',
        'screen_size_width',
        'screen_size_height',
        'device_type',
        'operating_system',
        'browser_version',
        'interaction',
    ];

    public function companyLeads()
    {
        return $this->belongsTo(CompanyLeads::class);
    }
}
