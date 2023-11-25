<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Send message if validation fails
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Veuillez renseigner votre email',
            'email.email' => 'Veuillez renseigner un email valide',
            'email.exists' => 'Cet email n\'est pas enregistré',
            'password.required' => 'Veuillez renseigner votre mot de passe',
            'password.string' => 'Veuillez renseigner un mot de passe valide'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string'
        ];
    }
}
