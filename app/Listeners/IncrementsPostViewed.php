<?php

namespace App\Listeners;

use App\Events\PostViewed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\PostView;

class IncrementsPostViewed
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostViewed  $event
     * @return void
     */
    public function handle(PostViewed $event)
    {
        $postViews = new PostView;
        $postViews->user_id = ( auth()->check() ) ? auth()->user()->id : 1;
        $postViews->post_id = $event->post->id;
        $postViews->save();
    }
}
