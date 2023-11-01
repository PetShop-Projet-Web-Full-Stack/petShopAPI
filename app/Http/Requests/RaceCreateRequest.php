<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaceCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:races,name,NULL,id,species_id,' . $this->input('species_id')],
            'species_id' => ['required', 'integer'],
        ];
    }
}
