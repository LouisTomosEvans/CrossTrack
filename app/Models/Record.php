<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'modelable_type', 'modelable_id', 'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function modelable() {
        return $this->morphTo();
    }
}
