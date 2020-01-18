<?php

namespace App\Http\Requests\Action;

use App\Http\Requests\FormRequest;

class AddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'game_id' => ['required', 'exists:games,id'],
            'actions' => ['required', 'string']
        ];
    }
}
