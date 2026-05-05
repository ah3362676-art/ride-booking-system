<?php

namespace App\Http\Requests\Trip;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTripRequest extends FormRequest
{
    /**
     * السماح بتنفيذ الطلب
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * قواعد التحقق عند تعديل رحلة
     */
    public function rules(): array
    {
        return [
            'vehicle_id' => ['required', 'exists:vehicles,id'],

            'start_address' => ['required', 'string', 'max:255'],
            'start_lat' => ['required', 'numeric', 'between:-90,90'],
            'start_lng' => ['required', 'numeric', 'between:-180,180'],

            'end_address' => ['required', 'string', 'max:255'],
            'end_lat' => ['required', 'numeric', 'between:-90,90'],
            'end_lng' => ['required', 'numeric', 'between:-180,180'],

            // في التعديل برضه هنشترط أنه يكون بعد الآن
            'departure_time' => ['required', 'date', 'after:now'],

            'available_seats' => ['required', 'integer', 'min:1', 'max:20'],
            'price_per_seat' => ['required', 'numeric', 'min:0'],

            'status' => ['required', Rule::in(['scheduled', 'in_progress', 'completed', 'cancelled'])],
        //    Rule::in =>  القيمة لازم تكون واحدة من القيم دي فقط

            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'start_address.required' => 'عنوان البداية مطلوب.',
            'start_lat.required' => 'خط عرض البداية مطلوب.',
            'start_lng.required' => 'خط طول البداية مطلوب.',
            'end_address.required' => 'عنوان النهاية مطلوب.',
            'end_lat.required' => 'خط عرض النهاية مطلوب.',
            'end_lng.required' => 'خط طول النهاية مطلوب.',
            'departure_time.required' => 'وقت الانطلاق مطلوب.',
            'available_seats.required' => 'عدد المقاعد المتاحة مطلوب.',
            'price_per_seat.required' => 'السعر لكل مقعد مطلوب.',
            'status.required' => 'حالة الرحلة مطلوبة.',
            'vehicle_id.exists' => 'المركبة المحددة غير موجودة.',
            'vehicle_id.required' => 'المركبة مطلوبة.',

        ];
    }

    /**
     * أسماء الحقول بالعربي
     */
    public function attributes(): array
    {
        return [
            'vehicle_id' => 'المركبة',
            'start_address' => 'عنوان البداية',
            'start_lat' => 'خط عرض البداية',
            'start_lng' => 'خط طول البداية',
            'end_address' => 'عنوان النهاية',
            'end_lat' => 'خط عرض النهاية',
            'end_lng' => 'خط طول النهاية',
            'departure_time' => 'وقت الانطلاق',
            'available_seats' => 'عدد المقاعد المتاحة',
            'price_per_seat' => 'السعر لكل مقعد',
            'status' => 'الحالة',
            'notes' => 'الملاحظات',
        ];
    }
}
