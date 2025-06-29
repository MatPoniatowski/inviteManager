<?php

declare(strict_types=1);

namespace App\Application\Event\DTO;

class EventDataDto
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly \DateTime $startsAt,
        public readonly \DateTime $endsAt,
        public readonly int $createdBy
    ) {
    }
}
