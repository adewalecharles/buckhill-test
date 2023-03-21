<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|alpha_dash|max:255',
            'last_name' => 'required|string|alpha_dash|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'avatar' =>  'sometimes|nullable|string|exists:files,uuid',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'is_marketing' => 'required|boolean'
        ];
    }
}
