<?php


namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        \App\Events\SymptomReported::class => [
            \App\Listeners\CreateAlertForSymptomReported::class,
        ],
        // You can add other event-listener pairs here as needed
    ];
}
