<?php

namespace App\Http\Requests;


use App\Domain\User\Enum\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'role' => ['required', 'string', 'in:' . implode(',', array_column(RoleEnum::cases(), 'value'))],
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}

