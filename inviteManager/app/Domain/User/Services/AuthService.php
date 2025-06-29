<?php

declare(strict_types=1);

namespace App\Domain\User\Services;

use App\Application\User\DTO\RegisterUserDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Enum\RoleEnum;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(RegisterUserRequest $request): User
    {
        $userDto = $this->createRegisterUserDto($request);
        $user = User::create([
            'name' => $userDto->name,
            'email' => $userDto->email,
            'password' => bcrypt($userDto->password),
        ]);
        $user->assignRole($userDto->role->value);

        return $user;
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginUserRequest $request): User
    {
        $request->authenticate();
        return User::where('email', $request->get('email'))->first();
    }

    public function createRegisterUserDto(RegisterUserRequest $request): RegisterUserDTO
    {
        return new RegisterUserDTO(
            name: $request->get('name'),
            email: $request->get('email'),
            password: $request->get('password'),
            role: RoleEnum::from($request->get('role')),
        );
    }
}
