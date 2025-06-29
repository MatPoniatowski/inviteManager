<?php

declare(strict_types=1);

namespace App\Application\Handlers\CommandHandlers;

use App\Application\Commands\Event\CreateEventCommand;
use App\Domain\Event\Entities\Event;
use App\Domain\Event\Repositories\EventRepositoryInterface;
use App\Domain\Events\EventCreated;

use Illuminate\Support\Facades\Event as Dispatcher;

class CreateEventHandler
{
    public function __construct(private EventRepositoryInterface $repository)
    {
    }

    public function handle(CreateEventCommand $command): Event
    {
        $event = $this->repository->save($command->data);
        Dispatcher::dispatch(new EventCreated($event));
        return $event;
    }
}
