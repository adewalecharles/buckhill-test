<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'password' => 'required|string|min:5|confirmed',
            'avatar' => 'sometimes|nullable|string|exists:files,uuid',
            'address' => 'required|string',
            'phone_number' => 'required|string',
        ];
    }
}
