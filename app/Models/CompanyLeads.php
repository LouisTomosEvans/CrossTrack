<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLeads extends Model
{
    use HasFactory;

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
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function visits()
    {
        return $this->hasMany(Visits::class);
    }

}
