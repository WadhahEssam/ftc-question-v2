<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PlayersAreReadyToStart implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $game , $user1Name , $user2Name ;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( $game , $user1Name , $user2Name )
    {
        $this->game = $game ;
        $this->user1Name = $user1Name ;
        $this->user2Name = $user2Name ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('game');
    }

    public function broadcastAs(){
        return 'PlayersAreReadyToStart' ;
    }


}
