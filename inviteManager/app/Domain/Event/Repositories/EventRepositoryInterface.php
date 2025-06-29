<?php

declare(strict_types=1);

namespace App\Domain\Event\Repositories;

use App\Application\Event\DTO\EventDataDto;
use App\Domain\Event\Entities\Event;

interface EventRepositoryInterface
{
    public function findById(int $id): ?Event;

    public function save(EventDataDto $event): Event;

    public function getUpcomingEvents(): iterable;

    public function search(?string $title, ?string $userName, ?\DateTimeInterface $startsAfter, ?int $userId);

}
