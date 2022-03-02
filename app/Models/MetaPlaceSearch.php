<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetaPlaceSearch extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'lat', 'lon', 'url', 'user_id'
    ];

    public function record() {
        $this->hasOne(Record::class)->where('modelable_type', '=', static::class);
    }

    public function user() {
        $this->hasOne(User::class, 'user_id');
    }

    public function places() {
        $this->hasMany(MetaPlace::class);
    }
}
