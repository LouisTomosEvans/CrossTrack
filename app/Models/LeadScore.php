<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyLeads;

class LeadScore extends Model
{
    use HasFactory;

    public function companyLead()
    {
        return $this->belongsTo(CompanyLeads::class);
    }

}


