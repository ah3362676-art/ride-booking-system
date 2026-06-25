<x-app-layout>
    <div class="p-6 max-w-5xl mx-auto">

        <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">

            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m2 5H7m12-5a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>

            My Trips
        </h2>

        @foreach ($trips as $passenger)

            <div class="border rounded-2xl p-5 mb-4 bg-white shadow-sm hover:shadow-md transition">

                {{-- Route --}}
                <p class="text-lg font-semibold flex items-center gap-2">

                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                    </svg>

                    {{ $passenger->trip->start_address }}
                    →
                    {{ $passenger->trip->end_address }}
                </p>

                {{-- Booking Info --}}
                <div class="mt-2 text-sm text-gray-600 space-y-1">

                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2"/>
                        </svg>

                        Seats: {{ $passenger->seats_booked }}
                    </p>

                    <p>
                        <span class="font-semibold">Total:</span>
                        {{ $passenger->total_price }}
                    </p>
                </div>

                {{-- Actions --}}
                <div class="mt-4 flex items-center gap-4">

                    {{-- Payment --}}
                    @if($passenger->payment_status !== 'paid')

                                            <a href="{{ route('payments.pay', $passenger->id) }}"
                    class="flex items-center gap-1 text-green-600 font-semibold hover:text-green-800">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 1.343-3 3v1h6v-1c0-1.657-1.343-3-3-3z"/>
                        </svg>

                        Pay Now
                    </a>

                    @else
                        <span class="flex items-center gap-1 text-green-700 font-bold">

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>

                            Paid
                        </span>
                    @endif


                    {{-- Chat --}}
                    <a href="{{ route('chat.show', $passenger->trip_id) }}"
                       class="flex items-center gap-1 text-blue-600 hover:text-blue-800">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4-.8L3 20l1.3-3.9C3.5 15 3 13.5 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>

                        Chat
                    </a>

                </div>

            </div>

        @endforeach

    </div>
</x-app-layout>
