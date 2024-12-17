<?php

namespace App\Providers;

use App\Models\Dish;
use App\Observers\DishObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string|string>>
     */
    protected $listen = [
        \App\Events\DishCreated::class => [
            \App\Listeners\SendDishCreatedNotification::class,
        ],
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        Dish::observe(DishObserver::class);
    }
} 