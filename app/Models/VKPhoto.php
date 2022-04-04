<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VKPhoto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'text', 'photo_id', 'lat', 'lon', 'preview_URL', 'album_id', 'owner_id', 'post_id', 'has_tags', 'date'
    ];

    public function vkPhotoSearches() {
        return $this->belongsToMany(VKPhotoSearch::class);
    }
}
