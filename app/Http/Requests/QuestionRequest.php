<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'answers' => ['required', 'array'],
            'answers.*.id_question' => ['required', 'integer'],
            'answers.*.answer' => ['required', 'string']
        ];
    }
}
