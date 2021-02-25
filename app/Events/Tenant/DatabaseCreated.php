<?php

namespace App\Events\Tenant;

use App\Models\Organizacao;
use App\Tenant\Database\DatabaseManager;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DatabaseCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $organizacao;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Organizacao $organizacao)
    {
        $this->organizacao = $organizacao;
    }

    public function getOrganizacao(){
        return $this->organizacao;
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
