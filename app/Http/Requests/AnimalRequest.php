<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'gender' => ['required', 'string', 'in:Male,Female'],
            'date_of_birth' => ['required', 'date'],
            'race_id' => ['required', 'integer'],
            'pet_shop_id' => ['required', 'integer']
        ];
    }
}
