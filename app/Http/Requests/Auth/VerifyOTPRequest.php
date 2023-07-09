<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOTPRequest extends FormRequest
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
            'otp' => 'required|string|min:6|max:6',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'otp.required' => 'OTP tidak boleh kosong',
            'otp.string' => 'OTP harus berupa string',
            'otp.min' => 'OTP harus 6 karakter',
            'otp.max' => 'OTP harus 6 karakter',
        ];
    }
}
