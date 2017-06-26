<?php

namespace App\Listeners;

use App\Events\ViewPostHandler;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Session;

class EventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $session;
    public $post;
    public function __construct()
    {
       
    }

    /**
     * Handle the event.
     *
     * @param  ViewPictureHandler  $event
     * @return void
     */
    public function handle(ViewPostHandler $event)
    {
        $post = $event->post;

        $viewed = $this->isPictureviewed($post);
       
        
        if(!$viewed){
            $this->storePicture($picture);
            $post->increment('view_count');
            $post->view_count +=1;
        }
        
        $posts = Session::get('viewed_picture');
        if(!is_null($posts))  $posts = $this->cleanExpiaredViews($posts);

       
    
    }

    private function storePicture($picture){
        $key = 'viewed_picture.'.$picture->id;
        Session::put($key,time());
        
    }

    private function isPictureviewed($picture){
        $viewed = Session::get('viewed_picture',[]);
        if(is_null($viewed)) $viewed=array();
        return array_key_exists($picture->id, $viewed);
    }

    private function cleanExpiaredViews($pictures){

        $time =time();

        $expiration_time = 15*60;

        if(is_null($pictures)) $pictures = array();
        
        return array_filter($pictures, function ($timestamp) use ($time, $expiration_time)
        {
            // If the view timestamp + the throttle time is 
            // still after the current timestamp the view  
            // has not expired yet, so we want to keep it.
            return ($timestamp + $expiration_time) > $time;
        });

    }
}
