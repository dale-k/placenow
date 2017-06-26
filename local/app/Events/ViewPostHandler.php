<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ViewPostHandler extends Event
{
    use SerializesModels;
    
   public $post;

   public function __construct(\App\Post $post)
    {
        $this->post = $post;
    }



    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
