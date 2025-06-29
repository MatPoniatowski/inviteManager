<?php

namespace App\Http\Requests;

use App\Application\Event\DTO\EventDataDto;
use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after_or_equal:starts_at',
        ];
    }

    public function toDto(): EventDataDto
    {
        return new EventDataDto(
            title: $this->input('title'),
            description: $this->input('description'),
            startsAt: new \DateTime($this->input('starts_at')),
            endsAt: new \DateTime($this->input('ends_at')),
            createdBy: $this->user()->id,
        );
    }
}
