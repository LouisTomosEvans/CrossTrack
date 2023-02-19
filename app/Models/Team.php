<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TeamTrait;
use Spark\Billable;

class Team extends Model
{
    use HasFactory;
    use TeamTrait;
    use Billable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * @var array
     */
    protected $fillable = ['name', 'owner_id'];

    public function stripeEmail()
    {
        return $this->owner()->email;
    }

    public function websites()
    {
        return $this->hasMany(Website::class);
    }


}
