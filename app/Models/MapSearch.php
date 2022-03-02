<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapSearch extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'lat', 'lon', 'website_id', 'url', 'user_id'
    ];


    public function website() {
        $this->hasOne(Website::class, 'website_id');
    }

    public function user() {
        $this->hasOne(User::class, 'user_id');
    }
}
