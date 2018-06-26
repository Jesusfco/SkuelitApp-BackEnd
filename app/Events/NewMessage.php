<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use App\Message;

class NewMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $message;
    public $conversation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
        $this->conversation = $message->conversation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat-channel.' . $this->getUserDestiny());
    }

    public function broadcastWith() {
        return [ 
          'message' => $this->message,
          'conversation' => $this->conversation
        ];
    }

    public function getUserDestiny() {

        $str = explode('>', $this->conversation->users_id);
        array_splice($str, count($str) - 1, 1);      
                
        foreach($str as $s) {
        
            $y = explode('<', $s);
            
            if($this->message->from_id != (int)$y[1]) {
                return (int)$y[1];
            }
                
        }

    }
}
