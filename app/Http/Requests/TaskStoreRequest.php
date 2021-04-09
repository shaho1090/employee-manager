<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|min:3|max:150',
            'note' => 'bail|required|string|min:3|max:255',
            'time' => 'bail|required|numeric|gt:0'
        ];
    }
}
