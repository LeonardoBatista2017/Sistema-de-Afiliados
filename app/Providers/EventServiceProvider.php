<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\PostViewed;
use App\Listeners\IncrementsPostViewed;
use App\Events\CommentAnswered;
use App\Listeners\SendMailCommentAnswered;
use App\Listeners\ChangeStatusCommentAnswered;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        PostViewed::class => [
            IncrementsPostViewed::class,
        ],
        CommentAnswered::class => [
            SendMailCommentAnswered::class,
            ChangeStatusCommentAnswered::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
