<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">

            {{-- Icon --}}
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>

            Match Details
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 space-y-4">

                    {{-- Route --}}
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">

                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                        </svg>

                        {{ $rideMatch->trip?->start_address }} → {{ $rideMatch->trip?->end_address }}
                    </h3>

                    {{-- Driver --}}
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.121 17.804A9 9 0 1118.364 4.56 9 9 0 015.12 17.804z"/>
                        </svg>

                        <span class="font-semibold">Driver:</span>
                        {{ $rideMatch->trip?->driver?->name }}
                    </p>

                    {{-- Vehicle --}}
                    <p>
                        <span class="font-semibold">Vehicle:</span>
                        {{ $rideMatch->trip?->vehicle?->brand }} - {{ $rideMatch->trip?->vehicle?->model }}
                    </p>

                    {{-- Plate --}}
                    <p>
                        <span class="font-semibold">Plate:</span>
                        {{ $rideMatch->trip?->vehicle?->plate_number }}
                    </p>

                    {{-- Time --}}
                    <p>
                        <span class="font-semibold">Departure:</span>
                        {{ $rideMatch->trip?->departure_time?->format('Y-m-d h:i A') }}
                    </p>

                    {{-- Seats --}}
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.126-1.283-.356-1.857"/>
                        </svg>

                        <span class="font-semibold">Seats:</span>
                        {{ $rideMatch->trip?->available_seats }}
                    </p>

                    {{-- Price --}}
                    <p>
                        <span class="font-semibold">Price:</span>
                        {{ number_format($rideMatch->trip?->price_per_seat ?? 0, 2) }}
                    </p>

                    {{-- Score --}}
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.159c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.286 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.286-3.955a1 1 0 00-.364-1.118L2.98 9.382c-.783-.57-.38-1.81.588-1.81h4.159a1 1 0 00.95-.69l1.286-3.955z"/>
                        </svg>

                        <span class="font-semibold">Match Score:</span>
                        {{ $rideMatch->match_score }}%
                    </p>

                    {{-- Reason --}}
                    <p>
                        <span class="font-semibold">Reason:</span>
                        {{ $rideMatch->match_reason ?: 'No reason provided' }}
                    </p>

                    {{-- Status --}}
                    <p>
                        <span class="font-semibold">Status:</span>
                        {{ $rideMatch->status }}
                    </p>

                    {{-- Back --}}
                    <div class="pt-4">
                        <a href="{{ route('ride-matches.index', $tripRequest) }}"
                           class="rounded-lg bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400 flex items-center gap-2">

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7"/>
                            </svg>

                            Back
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
