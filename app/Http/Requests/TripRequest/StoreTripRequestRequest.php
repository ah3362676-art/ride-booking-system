<?php

namespace App\Http\Requests\TripRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripRequestRequest extends FormRequest
{
    /**
     * السماح بتنفيذ الطلب
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * قواعد التحقق عند إنشاء طلب رحلة
     */
    public function rules(): array
    {
        return [
            'start_address' => ['required', 'string', 'max:255'],
            'start_lat' => ['required', 'numeric', 'between:-90,90'],
            'start_lng' => ['required', 'numeric', 'between:-180,180'],

            'end_address' => ['required', 'string', 'max:255'],
            'end_lat' => ['required', 'numeric', 'between:-90,90'],
            'end_lng' => ['required', 'numeric', 'between:-180,180'],

            'requested_seats' => ['required', 'integer', 'min:1', 'max:10'],

            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'start_address.required' => 'عنوان البداية مطلوب',
            'start_lat.required' => 'خط عرض البداية مطلوب',
            'start_lng.required' => 'خط طول البداية مطلوب',
            'end_address.required' => 'عنوان النهاية مطلوب',
            'end_lat.required' => 'خط عرض النهاية مطلوب',
            'end_lng.required' => 'خط طول النهاية مطلوب',
            'requested_seats.required' => 'عدد المقاعد المطلوبة مطلوب',
            'notes.required' => 'الملاحظات مطلوبة',
        ];
    }

    /**
     * أسماء الحقول بالعربي
     */
    public function attributes(): array
    {
        return [
            'start_address' => 'عنوان البداية',
            'start_lat' => 'خط عرض البداية',
            'start_lng' => 'خط طول البداية',
            'end_address' => 'عنوان النهاية',
            'end_lat' => 'خط عرض النهاية',
            'end_lng' => 'خط طول النهاية',
            'requested_seats' => 'عدد المقاعد المطلوبة',
            'notes' => 'الملاحظات',
        ];
    }
}
