<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Application\Event\DTO\EventDataDto;
use App\Domain\Event\Entities\Event;
use App\Domain\Event\Repositories\EventRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class EventRepository implements EventRepositoryInterface
{

    public function getUpcomingEvents(): iterable
    {
        return Event::upcoming()->get();
    }

    public function findById(int $id): ?Event
    {
        return Event::find($id);
    }

    public function save(EventDataDto $event): Event
    {
        return Event::create([
            'title' => $event->title,
            'description' => $event->description,
            'start_at' => $event->startsAt,
            'end_at' => $event->endsAt,
            'created_by' => $event->createdBy,
        ]);
    }

    public function search(?string $title, ?string $userName, ?\DateTimeInterface $startsAfter, ?int $userId)
    {
        $query = Event::query();

        $this->applyTitleFilter($query, $title);
        $this->applyStartsAfterFilter($query, $startsAfter);
        $this->applyUserIdFilter($query, $userId);
        $this->applyUserNameFilter($query, $userName);

        return $query->get();
    }

    private function applyUserNameFilter(Builder $query, ?string $userName): void
    {
        if ($userName) {
            $query->whereHas('user', function (Builder $query) use ($userName) {
                $query->where('name', 'like', '%' . $userName . '%');
            });
        }
    }
    private function applyTitleFilter(Builder $query, ?string $title): void
    {
        if ($title) {
            $query->where('title', 'like', '%' . $title . '%');
        }
    }

    private function applyStartsAfterFilter(Builder $query, ?\DateTimeInterface $startsAfter): void
    {
        if ($startsAfter) {
            $query->where('starts_at', '>=', $startsAfter);
        }
    }

    private function applyUserIdFilter(Builder $query, ?int $userId): void
    {
        if ($userId) {
            $query->where('user_id', $userId);
        }
    }
}
