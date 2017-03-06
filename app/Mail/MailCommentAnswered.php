<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailCommentAnswered extends Mailable
{
    use Queueable, SerializesModels;
    
    public $comment, $reply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($comment, $reply)
    {
        $this->comment = $comment;
        $this->reply = $reply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->subject('Seu comentário foi respondido')
                ->from('carlos@especializati.com.br', 'Carlos Ferreira!')
                ->to($this->comment->email)
                ->view('mails.comments.answer_comment');
    }
}
