<?php

declare(strict_types=1);

namespace App\Domain\Events;

use App\Domain\Event\Entities\Event;

class EventCreated
{
    public function __construct(public Event $event)
    {
    }
}
