<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'race' => ['nullable', 'string'],
            'species' => ['nullable', 'string'],
            'age_min' => ['required_with:age_max', 'integer', 'before_or_equal:age_max'],
            'age_max' => ['required_with:age_min', 'integer', 'after_or_equal:age_min'],
        ];
    }
}
