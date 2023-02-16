<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class UserLeftTeam
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @type Model
     */
    protected $user;

    /**
     * @type int
     */
    protected $team_id;

    public function __construct($user, $team_id)
    {
        $this->user = $user;
        $this->team_id = $team_id;
    }

    /**
     * @return Model
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getTeamId()
    {
        return $this->team_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
