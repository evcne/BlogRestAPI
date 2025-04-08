<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images' => 'array', 
            'images.*' => 'string', 
        ];
    }

    /**
     * Get custom error messages for validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Post title is required.',
            'content.required' => 'Post content is required.',
            'images.string' => 'Post image is must array format.',
            'images.required' => 'Post images are required.',
            'images.array' => 'Post images must be an array.',
            'images.*.required' => 'Each post image is required.',
        ];
    }
}
