<?php

declare(strict_types=1);

namespace Tests\Handlers\QueryHandlers\Event;

use App\Application\Handlers\QueryHandlers\Event\ListFiltredEventsHandler;
use App\Domain\Event\Repositories\EventRepositoryInterface;
use App\Http\Requests\SearchEventRequest;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ListFiltredEventsHandlerTest extends TestCase
{
    public function testItReturnsEventsBasedOnFilters()
    {
        $mockRepo = \Mockery::mock(EventRepositoryInterface::class);
        $mockRepo->shouldReceive('search')
            ->once()
            ->with('test', null, null, null)
            ->andReturn(collect([['title' => 'meeting']]));

        $handler = new ListFiltredEventsHandler($mockRepo);

        $request = new SearchEventRequest([
            'title' => 'test',
            'user_name' => null,
            'starts_after' => null,
            'user_id' => null,
        ]);

        $result = $handler->handle($request);

        $this->assertEquals('meeting', $result->first()['title']);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals('meeting', $result->first()['title']);
    }
}
