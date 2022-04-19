<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IPAddress extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "status", "country", "countryCode", "region", "regionName", "city", "zip", "lat", "lon", "isp", "org", "mobile", "proxy", "hosting", "query", 'user_id'
    ];

    public function user() {
        $this->hasOne(User::class, 'user_id');
    }
}
