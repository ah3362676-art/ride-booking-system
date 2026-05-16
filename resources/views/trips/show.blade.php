<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">
            Trip Details
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white rounded-3xl shadow-lg p-8 space-y-6">

                {{-- Title --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">
                        {{ $trip->start_address }} → {{ $trip->end_address }}
                    </h3>

                    <p class="text-gray-500 mt-1">
                        Full trip information overview
                    </p>
                </div>

                {{-- Info Grid --}}
                <div class="grid md:grid-cols-2 gap-4 text-sm">

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-gray-500">Vehicle</p>
                        <p class="font-bold text-gray-800">
                            {{ $trip->vehicle?->brand }} {{ $trip->vehicle?->model }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-gray-500">Plate Number</p>
                        <p class="font-bold text-gray-800">
                            {{ $trip->vehicle?->plate_number }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-gray-500">Departure Time</p>
                        <p class="font-bold text-gray-800">
                            {{ $trip->departure_time?->format('Y-m-d h:i A') }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-gray-500">Status</p>
                        <span class="inline-block mt-1 px-3 py-1 rounded-full bg-gray-200 text-gray-800 font-semibold">
                            {{ ucfirst($trip->status) }}
                        </span>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-gray-500">Available Seats</p>
                        <p class="font-bold text-gray-800">
                            {{ $trip->available_seats }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-gray-500">Price per Seat</p>
                        <p class="font-bold text-green-600">
                            {{ number_format($trip->price_per_seat, 2) }}
                        </p>
                    </div>

                </div>

                {{-- Notes --}}
                <div class="bg-gray-50 rounded-2xl p-4">
                    <p class="text-gray-500 mb-2">Notes</p>
                    <p class="text-gray-700">
                        {{ $trip->notes ?: 'No notes available' }}
                    </p>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-3 pt-2">

                    <a href="{{ route('trips.edit', $trip) }}"
                        class="bg-black text-white px-6 py-3 rounded-2xl hover:bg-gray-800 transition">
                        Edit Trip
                    </a>

                    <a href="{{ route('trips.index') }}"
                        class="bg-gray-200 text-gray-700 px-6 py-3 rounded-2xl hover:bg-gray-300 transition">
                        Back
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
