<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $stage_id;
    public $title;
    public $description;



    public function __construct($data)
    {
        $this->stage_id = $data['stage_id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
    }

    public function broadcastOn()
    {
        return [
            new Channel('new-notification'),

        ];
    }
    public function broadcastAs()
    {
        return 'my-event-notification';
    }
}

