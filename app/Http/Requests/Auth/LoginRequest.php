<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * السماح للجميع بطلب تسجيل الدخول
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * قواعد التحقق من بيانات تسجيل الدخول
     */
    public function rules(): array
    {
        return [
            // البريد مطلوب وصحيح
            'email' => ['required', 'email'],

            // كلمة المرور مطلوبة
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'البريد الإلكتروني يجب أن يكون بصيغة صحيحة.',

            'password.required' => 'كلمة المرور مطلوبة.',
            'password.string' => 'كلمة المرور يجب أن تكون نصًا.',
        ];
    }
    /**
     * أسماء الحقول بالعربي
     */
    public function attributes(): array
    {
        return [
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
        ];
    }
}
