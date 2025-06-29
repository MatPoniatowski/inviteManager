<?php

namespace App\Providers;

use App\Application\Listeners\SendEventCreatedNotification;
use App\Domain\Event\Repositories\EventRepositoryInterface;
use App\Domain\Events\EventCreated;
use App\Infrastructure\Persistence\Eloquent\Repositories\EventRepository;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            EventRepositoryInterface::class,
            EventRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            EventCreated::class,
            SendEventCreatedNotification::class,
        );
    }
}
