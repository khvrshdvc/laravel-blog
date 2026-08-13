<?php

namespace App\Providers;

use App\Events\PostCreated;
use App\Listeners\SendEmailToUser;
use App\Listeners\SendNotificationToAdmin;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Event::listen(
            PostCreated::class,
            [SendEmailToUser::class, 'handle']
        );

        Event::listen(
            PostCreated::class,
            [SendNotificationToAdmin::class, 'handle']
        );
    }
}
