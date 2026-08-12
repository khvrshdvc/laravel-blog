<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => 'required',
            'type_body' => 'required',
            'short_body' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'sarlavha to\'ldirish majburiy!',
            'type_body.required' => 'xulosa to\'ldirish majburiy!',
            'short_body.required' => 'mavzu to\'ldirish majburiy!',
            'body.required' => 'matn to\'ldirish majburiy!',
            'image.image' => 'rasm ko\'rinishida bo\'lishi majburiy!'
        ];
    }
}
