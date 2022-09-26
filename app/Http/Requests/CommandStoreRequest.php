<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'command' => ['required', 'max:255', 'string'],
            'description' => ['nullable'],
            'project_id' => ['required', 'exists:projects,id'],
        ];
    }
}
