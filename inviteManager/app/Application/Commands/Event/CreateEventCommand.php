<?php

declare(strict_types=1);

namespace App\Application\Commands\Event;

use App\Application\Event\DTO\EventDataDto;

class CreateEventCommand
{
    public function __construct(public EventDataDto $data)
    {
    }
}
