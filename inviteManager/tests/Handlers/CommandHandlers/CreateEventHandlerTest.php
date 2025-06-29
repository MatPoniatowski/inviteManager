<?php

declare(strict_types=1);

namespace Tests\Handlers\CommandHandlers;

use App\Application\Event\DTO\EventDataDto;
use App\Application\Commands\Event\CreateEventCommand;
use App\Application\Handlers\CommandHandlers\CreateEventHandler;
use App\Domain\Event\Entities\Event;
use App\Domain\Event\Repositories\EventRepositoryInterface;
use App\Domain\Events\EventCreated;
use Illuminate\Support\Facades\Event as EventFacade;
use Tests\TestCase;
use Mockery;

class CreateEventHandlerTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testHandleDispatchesEventAndReturnsEvent()
    {
        $data = new EventDataDto(
            title: 'Test Event',
            description: 'Description',
            startsAt: new \DateTime('2025-07-01 12:00:00'),
            endsAt: new \DateTime('2025-07-01 12:40:00'),
            createdBy: 1
        );
        $command = new CreateEventCommand($data);
        $event = Mockery::mock(Event::class);

        $repository = Mockery::mock(EventRepositoryInterface::class);
        $repository->shouldReceive('save')
            ->once()
            ->with($data)
            ->andReturn($event);

        EventFacade::shouldReceive('dispatch')
            ->once()
            ->with(
                Mockery::on(function ($arg) use ($event) {
                    return $arg instanceof EventCreated && $arg->event === $event;
                })
            );

        $handler = new CreateEventHandler($repository);
        $result = $handler->handle($command);
        $this->assertSame($event, $result);
    }

    public function testItCreatesEventAndDispatchesEventCreated()
    {
        EventFacade::fake();

        $dto = new EventDataDto(
            title: 'Test',
            description: 'desc',
            startsAt: now(),
            endsAt: now()->addHour(),
            createdBy: 1
        );

        $mockRepo = Mockery::mock(EventRepositoryInterface::class);
        $mockRepo->shouldReceive('save')->once()->with($dto)->andReturn(new Event());

        $handler = new CreateEventHandler($mockRepo);
        $handler->handle(new CreateEventCommand($dto));

        EventFacade::assertDispatched(EventCreated::class);
    }
}
