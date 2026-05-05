<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    /**
     * هل المستخدم مسموح له بهذا الطلب؟
     */
    public function authorize(): bool
    {
        // مؤقتًا: أي مستخدم مسجل يمكنه الإضافة
        // لاحقًا ممكن نقيّدها على السائق فقط
        return auth()->check();
    }

    /**
     * قواعد التحقق عند إنشاء مركبة
     */
    public function rules(): array
    {
        return [
            // الشركة المصنعة مطلوبة
            'brand' => ['required', 'string', 'max:255'],

            // الموديل مطلوب
            'model' => ['required', 'string', 'max:255'],

            // اللون مطلوب
            'color' => ['required', 'string', 'max:255'],

            // رقم اللوحة مطلوب وفريد
            'plate_number' => ['required', 'string', 'max:255', 'unique:vehicles,plate_number'],

            // عدد المقاعد مطلوب ويكون رقم صحيح
            'seats_count' => ['required', 'integer', 'min:1', 'max:20'],

            // حالة التفعيل اختيارية
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'brand.required' => 'الشركة المصنعة مطلوبة',
            'model.required' => 'موديل السيارة مطلوب',
            'color.required' => 'اللون مطلوب',
            'plate_number.required' => 'رقم اللوحة مطلوب',
            'plate_number.unique' => 'رقم اللوحة مستخدم بالفعل',
            'seats_count.required' => 'عدد المقاعد مطلوب',
            'seats_count.integer' => 'عدد المقاعد يجب أن يكون رقمًا صحيحًا',
            'seats_count.min' => 'عدد المقاعد يجب أن يكون 1 على الأقل',
            'seats_count.max' => 'عدد المقاعد يجب أن يكون 20 على الأكثر',
        ];
    }



    /**
     * أسماء الحقول بالعربي
     */
    public function attributes(): array
    {
        return [
            'brand' => 'الشركة المصنعة',
            'model' => 'موديل السيارة',
            'color' => 'اللون',
            'plate_number' => 'رقم اللوحة',
            'seats_count' => 'عدد المقاعد',
            'is_active' => 'حالة التفعيل',
        ];
    }
}
