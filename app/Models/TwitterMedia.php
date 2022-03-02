<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterMedia extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // MapSearches of this website
    public function mapSearches(){
        return $this->hasMany(MapSearch::class);
    }
}
