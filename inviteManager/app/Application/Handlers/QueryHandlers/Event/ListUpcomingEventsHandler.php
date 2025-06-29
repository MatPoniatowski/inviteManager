<?php

declare(strict_types=1);

namespace App\Application\Handlers\QueryHandlers\Event;

use App\Domain\Event\Entities\Event;

class ListUpcomingEventsHandler
{
    public function handle()
    {
        return Event::upcoming()->get();
    }
}
