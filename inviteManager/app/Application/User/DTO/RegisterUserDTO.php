<?php

declare(strict_types=1);

namespace App\Application\User\DTO;

use App\Domain\User\Enum\RoleEnum;

readonly class RegisterUserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public RoleEnum $role,
    ) {
    }
}
