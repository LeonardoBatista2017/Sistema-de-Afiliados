<?php
namespace App\Listeners;

use App\Events\CommentAnswered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeStatusCommentAnswered
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
     * @param  CommCommentAnswered  $event
     * @return void
     */
    public function handle(CommentAnswered $event)
    {
        $comment = $event->comment();
        $comment->status = 'A';
        $comment->save();
    }
}
