<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdatePostRequest extends FormRequest
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
            //'images' => 'array', // Resimler bir dizi olmalıdır
            //'images.*' => 'string', // Her bir resim bir string olmalıdır (dosya yolu)
        ];
    }

     /**
     * Doğrulama hataları için özelleştirilmiş mesajlar.
     *
     * @return array
     */
    public function messages()
    {
        return [
            /*'id.required' => 'Post ID is required.',
            'id.integer' => 'Post ID must be an integer.',
            'id.exists' => 'The selected Post ID is invalid.',*/
            'title.required' => 'Post title is required.',
            'content.required' => 'Post content is required.',
            //'images.string' => 'Post image is must array format.',
            /*'images.required' => 'Post images are required.',
            'images.array' => 'Post images must be an array.',
            'images.*.required' => 'Each post image is required.',*/
        ];
    }
}
