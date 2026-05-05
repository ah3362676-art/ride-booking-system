<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * السماح بالمحاولة
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * قواعد التحقق عند تعديل مركبة
     */
    public function rules(): array
    {
        // جلب المركبة من الراوت
        $vehicle = $this->route('vehicle');

        return [
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],

            // تجاهل نفس المركبة في التحقق من unique
            'plate_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vehicles', 'plate_number')->ignore($vehicle?->id),
            ],

            'seats_count' => ['required', 'integer', 'min:1', 'max:20'],
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
