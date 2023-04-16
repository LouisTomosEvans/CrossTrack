<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Team;
use App\Models\Invites;

use App\Events\UserInvitedToTeam;
use App\Events\UserJoinedTeam;
use App\Events\UserLeftTeam;



class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['last_active_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user', 'user_id', 'team_id')->withTimestamps()->withPivot('active', 'invite');
    }

    /**
     * Belongs-to relation with the current selected team model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currentTeam()
    {
        return $this->belongsTo(Team::class, 'current_team_id', 'id');
    }

    /**
     * @return mixed
     */
    public function ownedTeams()
    {
        return $this->teams()->where('owner_id', '=', $this->getKey());
    }

    /**
     * One-to-Many relation with the invite model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManygs
     * 
     */
    public function invites()
    {
        return $this->hasMany(Invites, 'email', 'email');
    }

    /**
     * Returns if the user owns a team.
     *
     * @return bool
     */
    public function isOwner()
    {
        return ($this->teams()->where('owner_id', '=', $this->getKey())->first()) ? true : false;
    }

    /**
     * Wrapper method for "isOwner".
     *
     * @return bool
     */
    public function isTeamOwner()
    {
        return $this->isOwner();
    }

    /**
     * @param  $team
     * @return mixed
     */
    protected function retrieveTeamId($team)
    {
        if (is_object($team)) {
            $team = $team->getKey();
        }
        if (is_array($team) && isset($team['id'])) {
            $team = $team['id'];
        }

        return $team;
    }

    /**
     * Returns if the user owns the given team.
     *
     * @param  mixed $team
     * @return bool
     */
    public function isOwnerOfTeam($team)
    {
        $team_id = $this->retrieveTeamId($team);

        return ($this->teams()
            ->where('owner_id', $this->getKey())
            ->where('team_id', $team_id)->first()
        ) ? true : false;
    }

    // is member of team
    public function isMemberOfTeam($team)
    {
        $team_id = $this->retrieveTeamId($team);

        $team = $this->teams()->where('team_id', $team_id)->first();

        // check pivot to see if they have invite
        if ($team && $team->pivot->invite == false && $team->pivot->active == true) {
            return true;
        } else {
            return false;
        }
    }

    // is invited to team
    public function isInvitedToTeam($team)
    {
        $team_id = $this->retrieveTeamId($team);

        return ($this->teams()
            ->where('team_id', $team_id)->where('invite', true)->first()
        ) ? true : false;
    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param  mixed $team
     * @param  array $pivotData
     * @return $this
     */
    public function attachTeam($team, $pivotData = [])
    {
        $team = $this->retrieveTeamId($team);
        /*
         * If the user has no current team,
         * use the attached one
         */
        if (is_null($this->current_team_id)) {
            $this->current_team_id = $team;
            $this->save();

            if ($this->relationLoaded('currentTeam')) {
                $this->load('currentTeam');
            }
        }

        // Reload relation
        $this->load('teams');

        if (! $this->teams->contains($team)) {
            $this->teams()->attach($team, $pivotData);

            event(new UserJoinedTeam($this, $team));

            if ($this->relationLoaded('teams')) {
                $this->load('teams');
            }
        }

        return $this;
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param  mixed $team
     * @return $this
     */
    public function detachTeam($team)
    {
        $team = $this->retrieveTeamId($team);
        
        // detach the team with pivot data
        $this->teams()->detach($team);
        $this->save();

        event(new UserLeftTeam($this, $team));

        if ($this->relationLoaded('teams')) {
            $this->load('teams');
        }

        /*
         * If the user has no more teams,
         * unset the current_team_id
         */
        if ($this->teams()->count() === 0 && $this->current_team_id === $team->id) {
            $this->current_team_id = null;
            $this->save();

            if ($this->relationLoaded('currentTeam')) {
                $this->load('currentTeam');
            }
        }

        // delete from pivot table

        return $this;
    }

    /**
     * Attach multiple teams to a user.
     *
     * @param  mixed $teams
     * @return $this
     */
    public function attachTeams($teams)
    {
        foreach ($teams as $team) {
            $this->attachTeam($team);
        }

        return $this;
    }

    /**
     * Detach multiple teams from a user.
     *
     * @param  mixed $teams
     * @return $this
     */
    public function detachTeams($teams)
    {
        foreach ($teams as $team) {
            $this->detachTeam($team);
        }

        return $this;
    }

    /**
     * Switch the current team of the user.
     *
     * @param  object|array|int $team
     * @return $this
     * @throws ModelNotFoundException
     * @throws UserNotInTeamException
     */
    public function switchTeam($team)
    {
        if ($team !== 0 && $team !== null) {
            $team = $this->retrieveTeamId($team);
            $teamObject = ( new Team )->find($team);
            if (! $teamObject) {
                $exception = new ModelNotFoundException();
                $exception->setModel(Team::class);
                throw $exception;
            }
            if (! $teamObject->users->contains($this->getKey())) {
                $exception = new UserNotInTeamException();
                $exception->setTeam($teamObject->name);
                throw $exception;
            }
        }
        $this->current_team_id = $team;
        $this->save();

        if ($this->relationLoaded('currentTeam')) {
            $this->load('currentTeam');
        }

        return $this;
    }

    public function companyLeads()
    {
        return $this->belongsToMany(CompanyLeads::class, 'lead_user');
    }

    public function segmentations()
    {
        return $this->belongsToMany(Segmentation::class, 'segmentation_user');
    }
}
