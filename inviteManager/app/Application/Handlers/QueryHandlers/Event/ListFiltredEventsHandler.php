<?php

declare(strict_types=1);

namespace App\Application\Handlers\QueryHandlers\Event;

use App\Application\Event\DTO\SearchEventsDto;
use App\Domain\Event\Repositories\EventRepositoryInterface;
use App\Http\Requests\SearchEventRequest;

class ListFiltredEventsHandler
{
    public function __construct(private EventRepositoryInterface $repository)
    {
    }

    public function handle(SearchEventRequest $request)
    {
        $query = $this->prepareDto($request);
        return $this->repository->search(
            $query->title,
            $query->userName,
            $query->startsAfter,
            $query->createdByUserId
        );
    }

    private function prepareDto(SearchEventRequest $request)
    {
        return new SearchEventsDto(
            title: $request->get('title'),
            userName: $request->get('userName'),
            startsAfter: $request->get('starts_after') ? new \DateTime($request->get('starts_after')) : null,
            createdByUserId: $request->user()?->id,
        );
    }
}
