<?php

declare(strict_types=1);

namespace App\Application\Listeners;

use App\Domain\Events\EventCreated;
use App\Application\Jobs\SendEventCreatedMail;

class SendEventCreatedNotification
{
    public function handle(EventCreated $event): void
    {
        SendEventCreatedMail::dispatch($event->event);
    }
}
