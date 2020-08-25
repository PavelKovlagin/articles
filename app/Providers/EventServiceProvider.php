<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use Log;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\onAddArticle' => [
            'App\Listeners\LogAddArticle'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen('onUpdateArticle', function($article, $user, $new_article_name){
            Log::info('Update new article', ['Username: ' . $user->user_name, 'Old article name: ' . $article->article_name, 'New article name: ' . $new_article_name]);
        });
    }
}
