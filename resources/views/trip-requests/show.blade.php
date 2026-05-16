<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">
            Trip Request Details
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white rounded-3xl shadow-lg p-8 space-y-6">

                {{-- Title --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">
                        {{ $tripRequest->start_address }} → {{ $tripRequest->end_address }}
                    </h3>

                    <p class="text-gray-500 text-sm mt-1">
                        Full request details overview
                    </p>
                </div>

                {{-- Status + Seats --}}
                <div class="grid md:grid-cols-2 gap-4">

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-gray-500 text-sm">Requested Seats</p>
                        <p class="text-xl font-bold text-gray-800">
                            {{ $tripRequest->requested_seats }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-gray-500 text-sm">Status</p>

                        <span class="inline-block mt-2 px-3 py-1 rounded-full bg-gray-200 text-gray-800 font-semibold text-sm">
                            {{ ucfirst($tripRequest->status) }}
                        </span>
                    </div>

                </div>

                {{-- Start Location --}}
                <div class="bg-gray-50 rounded-2xl p-4 space-y-2">

                    <p class="font-semibold text-gray-700">📍 Start Location</p>

                    <p class="text-gray-700">
                        {{ $tripRequest->start_address }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Lat: {{ $tripRequest->start_lat }} / Lng: {{ $tripRequest->start_lng }}
                    </p>

                </div>

                {{-- End Location --}}
                <div class="bg-gray-50 rounded-2xl p-4 space-y-2">

                    <p class="font-semibold text-gray-700">🎯 Destination</p>

                    <p class="text-gray-700">
                        {{ $tripRequest->end_address }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Lat: {{ $tripRequest->end_lat }} / Lng: {{ $tripRequest->end_lng }}
                    </p>

                </div>

                {{-- Notes --}}
                <div class="bg-gray-50 rounded-2xl p-4">

                    <p class="font-semibold text-gray-700 mb-2">📝 Notes</p>

                    <p class="text-gray-600 text-sm">
                        {{ $tripRequest->notes ?: 'No notes available' }}
                    </p>

                </div>

                {{-- Matched Trip --}}
                @if ($tripRequest->matchedTrip)
                    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-5">

                        <p class="font-semibold text-blue-800 mb-2">
                            🤝 Matched Trip Found
                        </p>

                        <p class="text-blue-700 text-sm">
                            {{ $tripRequest->matchedTrip->start_address }}
                            →
                            {{ $tripRequest->matchedTrip->end_address }}
                        </p>

                    </div>
                @else
                    <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-4">
                        <p class="text-yellow-700 text-sm">
                            No match found yet. Try generating matches.
                        </p>
                    </div>
                @endif

                {{-- Actions --}}
                <div class="flex items-center gap-3 pt-2">

                    <a href="{{ route('trip-requests.edit', $tripRequest) }}"
                       class="bg-black text-white px-6 py-3 rounded-2xl hover:bg-gray-800 transition">
                        Edit
                    </a>

                    <a href="{{ route('trip-requests.index') }}"
                       class="bg-gray-200 text-gray-700 px-6 py-3 rounded-2xl hover:bg-gray-300 transition">
                        Back
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
