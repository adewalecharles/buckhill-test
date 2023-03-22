<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
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
            'file' => 'required|image|mimes:png,jpg,jpeg,svg,gif|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'file.max' => 'The document may not be greater than 10 megabytes',
            'file.required' => 'You must upload a valid file',
            'file.image' => 'File must be a valid file',
        ];
    }
}
