<?php

namespace App\Http\Requests\Feature\Quran;

use Illuminate\Foundation\Http\FormRequest;

class DetailSurahRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'surah' => 'required|string|max:114'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'surah.required' => 'Surah tidak boleh kosong',
            'surah.string' => 'Surah harus berupa string',
            'surah.max' => 'Surah tidak boleh lebih dari 114'
        ];
    }
}
