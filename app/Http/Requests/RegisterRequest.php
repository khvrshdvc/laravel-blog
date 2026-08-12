<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'ism kiritish majburiy!',
            'name.string' => 'ism faqat matn bo\'lishi kerak!',
            'name.max' => 'ism 255 ta belgidan oshmasligi kerak!',

            'email.required' => 'email kiritish majburiy!',
            'email.email' => 'email noto\'g\'ri formatda!',
            'email.unique' => 'bu email allaqachon ro\'yxatdan o\'tgan!',

            'password.required' => 'parol kiritish majburiy!',
            'password.min' => 'parol kamida 8 ta belgidan iborat bo\'lishi kerak!',
            'password.confirmed' => 'parollar bir xil emas!',
        ];
    }
}