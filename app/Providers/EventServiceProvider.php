<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var arraye
     */
    protected $listen = [
        'App\Events\IdTarigarioRegister' => [
            'App\Listeners\EventListener',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return voide
     */
    public function boot()
    {
        parent::boot();

        //
    }
}