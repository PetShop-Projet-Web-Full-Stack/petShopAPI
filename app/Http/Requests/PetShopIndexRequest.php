<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetShopIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city' => ['nullable', 'string'],
            'zipcode' => ['nullable', 'string']
        ];
    }
}
