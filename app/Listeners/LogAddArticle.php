<?php

namespace App\Listeners;

use App\Events\onAddArticle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Log;

class LogAddArticle
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
     * @param  onAddArticle  $event
     * @return void
     */
    public function handle(onAddArticle $event)
    {
        Log::info('Insert new article', [$event->user->user_name, $event->article->name]);
    }
}
