<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">
            My Trips
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-7xl mx-auto px-4 space-y-6">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Add Trip --}}
            <div class="flex justify-end">
                <a href="{{ route('trips.create') }}"
                   class="bg-black text-white px-5 py-3 rounded-2xl hover:bg-gray-800 transition">
                    + Create Trip
                </a>
            </div>

            {{-- Trips Grid --}}
            <div class="grid md:grid-cols-2 gap-6">

                @forelse ($trips as $trip)

                    <div class="bg-white rounded-3xl shadow hover:shadow-xl transition p-6 space-y-4">

                        {{-- Route --}}
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">
                                {{ $trip->start_address }} → {{ $trip->end_address }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Trip route details
                            </p>
                        </div>

                        {{-- Info --}}
                        <div class="grid grid-cols-2 gap-3 text-sm">

                            <div>
                                <p class="text-gray-500">Vehicle</p>
                                <p class="font-bold text-gray-800">
                                    {{ $trip->vehicle?->brand }} {{ $trip->vehicle?->model }}
                                </p>
                            </div>

                            <div>
                                <p class="text-gray-500">Departure</p>
                                <p class="font-bold text-gray-800">
                                    {{ $trip->departure_time?->format('Y-m-d h:i A') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-gray-500">Seats</p>
                                <p class="font-bold text-gray-800">
                                    {{ $trip->available_seats }}
                                </p>
                            </div>

                            <div>
                                <p class="text-gray-500">Price</p>
                                <p class="font-bold text-green-600">
                                    {{ number_format($trip->price_per_seat, 2) }}
                                </p>
                            </div>

                        </div>

                        {{-- Status --}}
                        <div>
                            <span class="text-sm px-3 py-1 rounded-full bg-gray-100 text-gray-700">
                                {{ $trip->status }}
                            </span>
                        </div>

                        {{-- Actions --}}
                        <div class="flex flex-wrap items-center gap-4 pt-2">

                            <a href="{{ route('trips.show', $trip) }}"
                               class="text-blue-600 hover:text-blue-800">
                                View
                            </a>

                            <a href="{{ route('trips.edit', $trip) }}"
                               class="text-yellow-600 hover:text-yellow-800">
                                Edit
                            </a>

                            {{-- Chat --}}
                            <a href="{{ route('chat.show', $trip->id) }}"
                               class="text-green-600 hover:text-green-700">
                                Chat
                            </a>

                            <form action="{{ route('trips.destroy', $trip) }}" method="POST"
                                  onsubmit="return confirm('Delete this trip?')">

                                @csrf
                                @method('DELETE')

                                <button class="text-red-600 hover:text-red-800">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="col-span-full text-center text-gray-500">
                        No trips available yet. Create your first trip 🚗
                    </div>

                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $trips->links() }}
            </div>

        </div>

    </div>

</x-app-layout>
