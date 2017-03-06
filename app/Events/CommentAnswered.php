<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Comment;

class CommentAnswered
{
    use InteractsWithSockets, SerializesModels;
    
    private $comment, $reply;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, $reply)
    {
        $this->comment = $comment;
        $this->reply = $reply;
    }
    
    public function comment()
    {
        return $this->comment;
    }
    
    public function reply()
    {
        return $this->reply;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
