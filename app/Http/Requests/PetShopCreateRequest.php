<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetShopCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'zipcode' => ['required', 'string', 'size:5'],
            'city' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:15'],
        ];
    }
}
