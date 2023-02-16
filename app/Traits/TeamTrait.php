<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use App\Models\Invite;
use App\Models\User;

trait TeamTrait
{
    /**
     * One-to-Many relation with the invite model.
     * @return mixed
     */
    public function invites()
    {
        return $this->hasMany(Invite::class, 'team_id', 'id');
    }

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'team_user', 'team_id', 'user_id')->withTimestamps()->withPivot('active', 'invite');
    }

    /**
     * Has-One relation with the user model.
     * This indicates the owner of the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        $userModel = Config::get('teamwork.user_model');
        $userKeyName = ( new $userModel() )->getKeyName();

        return $this->belongsTo($userModel, 'owner_id', $userKeyName);
    }

    /**
     * Helper function to determine if a user is part
     * of this team.
     *
     * @param Model $user
     * @return bool
     */
    public function hasUser(Model $user)
    {
        return $this->users()->where($user->getKeyName(), '=', $user->getKey())->first() ? true : false;
    }

}