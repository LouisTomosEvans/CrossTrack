<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetaPlace extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'address', 'minimum_age', 'external_id_source', 'external_id', 'lat', 'lon'
    ];

    public function metaPlaceSearches() {
        return $this->belongsToMany(MetaPlaceSearch::class);
    }
}
