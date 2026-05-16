<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">رحلاتي</h2>

        @foreach ($trips as $passenger)

            <div class="border p-4 mb-3 rounded">

                {{-- الرحلة --}}
                <p>
                    {{ $passenger->trip->start_address }}
                    →
                    {{ $passenger->trip->end_address }}
                </p>

                {{-- بيانات الحجز --}}
                <p>المقاعد: {{ $passenger->seats_booked }}</p>
                <p>الإجمالي: {{ $passenger->total_price }}</p>

                {{-- زر الدفع --}}
                @if($passenger->payment_status !== 'paid')
                    <a href="{{ route('payment.pay', $passenger->id) }}"
                       class="text-green-600 font-bold">
                        ادفع الآن
                    </a>
                @else
                    <span class="text-green-700 font-bold">
                        مدفوع ✔
                    </span>
                @endif

                {{-- زر الشات (زي ما هو بدون أي تغيير) --}}
                <a href="{{ route('chat.show', $passenger->trip_id) }}"
                   class="text-blue-600 ml-4">
                    فتح الشات
                </a>

            </div>

        @endforeach

    </div>
</x-app-layout>
