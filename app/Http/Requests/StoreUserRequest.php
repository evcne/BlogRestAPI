<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:4',
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
            'name.required' => 'Kullanıcı adı gereklidir.',
            'name.string' => 'Kullanıcı adı geçersiz bir formatta.',
            'name.max' => 'Kullanıcı adı en fazla 255 karakter olmalıdır.',
            'email.required' => 'E-posta adresi gereklidir.',
            'email.email' => 'Geçersiz bir e-posta adresi.',
            'email.unique' => 'Bu e-posta adresi zaten alınmış.',
            'email.max' => 'E-posta adresi en fazla 255 karakter olmalıdır.',
            'password.required' => 'Şifre gereklidir.',
            'password.string' => 'Şifre geçersiz bir formatta.',
            'password.min' => 'Şifre en az 4 karakter olmalıdır.',
        ];
    }
}
