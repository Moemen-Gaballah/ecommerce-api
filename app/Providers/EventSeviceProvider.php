<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Listeners\SendOrderNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EventSeviceProvider extends ServiceProvider
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
            OrderCreated::class,
            SendOrderNotification::class,
        );
    }
}
