<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;
use App\Models\Team;
use App\Models\User;

trait TeamInviteTrait
{
    /**
     * Has-One relations with the team model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function team()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    /**
     * Has-One relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email');
    }

    /**
     * Has-One relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inviter()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}