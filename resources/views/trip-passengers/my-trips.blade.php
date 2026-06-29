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
<div class="mt-4">

    @if($passenger->payment_status !== 'paid')

        <div class="flex flex-wrap items-center gap-3">

            {{-- Card Payment --}}
            <a href="{{ route('payments.pay', $passenger) }}"
               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                💳 Pay with Card
            </a>

            {{-- Wallet Payment --}}
            <form action="{{ route('payments.wallet', $passenger) }}" method="POST" class="flex items-center gap-2">
                @csrf

                <input
                    type="text"
                    name="phone"
                    placeholder="01012345678"
                    class="border rounded-lg px-3 py-2"
                    required
                >

                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    📱 Wallet
                </button>
            </form>

            {{-- Chat --}}
            <a href="{{ route('chat.show', $passenger->trip_id) }}"
               class="text-blue-600 hover:text-blue-800 font-semibold">
                💬 Chat
            </a>

        </div>

    @else

        <div class="flex items-center gap-4">

            <span class="text-green-700 font-bold">
                ✅ Paid
            </span>

            <a href="{{ route('chat.show', $passenger->trip_id) }}"
               class="text-blue-600 hover:text-blue-800 font-semibold">
                💬 Chat
            </a>

        </div>

    @endif

</div>

            </div>

        @endforeach

    </div>
</x-app-layout>
