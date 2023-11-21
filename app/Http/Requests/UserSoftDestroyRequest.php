<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSoftDestroyRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'id.required' => 'L\'id est requis',
            'id.exists' => 'L\'id n\'existe pas dans la base de données',
            'id.numeric' => 'L\'id doit être un identifiant numérique',
        ];
    }

    public function rules(): array
    {
        return [
            'id' => 'required|numeric|exists:users,id',
        ];
    }
}
