<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TwitterSearch extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'lat', 'lon', 'url', 'user_id', 'twitter_media_id', 'min_likes', 'min_retweets', 'radius', 'question', 'keywords'
    ];

    public function record() {
        $this->hasOne(Record::class)->where('modelable_type', '=', static::class);
    }

    public function mediaType() {
        $this->hasOne(Website::class, 'twitter_media_id');
    }

    public function user() {
        $this->hasOne(User::class, 'user_id');
    }
}
