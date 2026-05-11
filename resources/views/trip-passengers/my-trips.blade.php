<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">رحلاتي</h2>

        @foreach ($trips as $passenger)

            <div class="border p-4 mb-3 rounded">

                {{-- الرحلة نفسها --}}
                <p>
                    {{ $passenger->trip->start_address }}
                    →
                    {{ $passenger->trip->end_address }}
                </p>

                {{-- بيانات الحجز --}}
                <p>المقاعد: {{ $passenger->seats_booked }}</p>
                <p>الإجمالي: {{ $passenger->total_price }}</p>

                {{-- زر الشات --}}
                <a href="{{ route('chat.show', $passenger->trip_id) }}"
                   class="text-blue-600">
                    فتح الشات
                </a>

            </div>

        @endforeach

    </div>
</x-app-layout>
