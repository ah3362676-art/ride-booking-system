<x-app-layout>
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">رحلاتي</h2>

        @foreach ($trips as $trip)
            <div class="border p-4 mb-3 rounded">
                <p>{{ $trip->trip->start_address }} → {{ $trip->trip->end_address }}</p>
                <p>المقاعد: {{ $trip->seats_booked }}</p>
                <p>الإجمالي: {{ $trip->total_price }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
