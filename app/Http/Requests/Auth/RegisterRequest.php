<?php

namespace App\Http\Requests\Auth;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\Enum;

class RegisterRequest extends FormRequest
{
    /**
     * هل المستخدم مسموح له يرسل الطلب؟
     * هنا نعم لأن التسجيل متاح للجميع
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * قواعد التحقق من بيانات التسجيل
     */
    public function rules(): array
    {
        return [
            // الاسم مطلوب ونصي وبحد أقصى 255
            'name' => ['required', 'string', 'max:255'],

            // البريد مطلوب وبصيغة إيميل وفريد
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],

            // الهاتف مطلوب وفريد
            'phone' => ['required', 'string', 'max:20', 'unique:users,phone'],

            // الدور مطلوب ويجب أن يكون من القيم المحددة
            'role' => ['required', new Enum(Role::class)],

            // كلمة المرور مع التأكيد وبقوة مناسبة
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب.',
            'name.string' => 'الاسم يجب أن يكون نصًا.',
            'name.max' => 'الاسم لا يجب أن يتجاوز 255 حرفًا.',

            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.string' => 'البريد الإلكتروني يجب أن يكون نصًا.',
            'email.email' => 'البريد الإلكتروني يجب أن يكون بصيغة صحيحة.',
            'email.max' => 'البريد الإلكتروني لا يجب أن يتجاوز 255 حرفًا.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',

            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.string' => 'رقم الهاتف يجب أن يكون نصًا.',
            'phone.max' => 'رقم الهاتف لا يجب أن يتجاوز 20 حرفًا.',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل.',

            'role.required' => 'الدور مطلوب.',
            'role.enum' => 'الدور غير صالح.',

            'password.required' => 'كلمة المرور مطلوبة.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        ];
    }
    /**
     * أسماء الحقول بالعربي داخل رسائل الخطأ
     */
    public function attributes(): array
    {
        return [
            'name' => 'الاسم',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف',
            'role' => 'الدور',
            'password' => 'كلمة المرور',
        ];
    }
}
