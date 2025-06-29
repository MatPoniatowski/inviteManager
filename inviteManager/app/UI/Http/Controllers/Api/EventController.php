<?php

namespace App\UI\Http\Controllers\Api;

use App\Application\Commands\Event\CreateEventCommand;
use App\Application\Handlers\CommandHandlers\CreateEventHandler;
use App\Application\Handlers\QueryHandlers\Event\ListFiltredEventsHandler;
use App\Application\Handlers\QueryHandlers\Event\ListUpcomingEventsHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchEventRequest;
use App\Http\Requests\StoreEventRequest;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function index(ListUpcomingEventsHandler $handler)
    {
        return response()->json($handler->handle());
    }
    public function store(StoreEventRequest $request, CreateEventHandler $handler)
    {
        $event = $handler->handle(new CreateEventCommand($request->toDto()));

        return response()->json($event, Response::HTTP_CREATED);
    }

    public function search(SearchEventRequest $request, ListFiltredEventsHandler $handler)
    {
        $events = $handler->handle($request);

        return response()->json($events);
    }
}
