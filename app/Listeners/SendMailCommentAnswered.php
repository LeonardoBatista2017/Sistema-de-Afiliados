<?php

namespace App\Listeners;

use App\Events\CommentAnswered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\MailCommentAnswered;

class SendMailCommentAnswered
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
        Mail::send(new MailCommentAnswered($event->comment(), $event->reply()));
    }
}
