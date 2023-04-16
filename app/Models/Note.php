<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyLeads;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    public function noteable()
    {
        return $this->morphTo();
    }
}
