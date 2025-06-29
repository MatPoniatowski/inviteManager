<?php

declare(strict_types=1);

namespace App\Application\Event\DTO;

class SearchEventsDto
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $userName,
        public readonly ?\DateTimeInterface $startsAfter,
        public readonly ?int $createdByUserId = null
    ) {}
}
