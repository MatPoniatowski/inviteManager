<?php

namespace App\Http\Requests;

use App\Application\Event\DTO\EventDataDto;
use Illuminate\Foundation\Http\FormRequest;

class SearchEventRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string'],
            'userName' => ['nullable', 'string'],
            'starts_after' => ['nullable', 'date'],
        ];
    }
}
