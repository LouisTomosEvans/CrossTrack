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

}
