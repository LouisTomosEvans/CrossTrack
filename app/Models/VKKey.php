<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VKKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'user_id'
    ];

    public function user() {
        $this->hasOne(User::class, 'user_id');
    }
}
