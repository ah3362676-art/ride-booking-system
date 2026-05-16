<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
            {{-- Icon --}}
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>

            Suggested Matches
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-700 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 rounded-lg bg-white p-4 shadow-sm">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>

                    Request: {{ $tripRequest->start_address }} → {{ $tripRequest->end_address }}
                </h3>

                <p class="text-sm text-gray-600 mt-1 flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.126-1.283-.356-1.857"/>
                    </svg>
                    Seats Required: {{ $tripRequest->requested_seats }}
                </p>

                <form action="{{ route('ride-matches.generate', $tripRequest) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Generate Matches
                    </button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @forelse ($matches as $match)
                        <div class="mb-4 rounded-lg border p-4">

                            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                                </svg>

                                {{ $match->trip?->start_address }} → {{ $match->trip?->end_address }}
                            </h3>

                            <div class="mt-2 space-y-1 text-sm text-gray-600">

                                <p>Driver: {{ $match->trip?->driver?->name }}</p>
                                <p>Vehicle: {{ $match->trip?->vehicle?->brand }} - {{ $match->trip?->vehicle?->model }}</p>
                                <p>Seats: {{ $match->trip?->available_seats }}</p>
                                <p>Price: {{ number_format($match->trip?->price_per_seat ?? 0, 2) }}</p>

                                <p class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.159c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.286 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.286-3.955a1 1 0 00-.364-1.118L2.98 9.382c-.783-.57-.38-1.81.588-1.81h4.159a1 1 0 00.95-.69l1.286-3.955z"/>
                                    </svg>

                                    Score: {{ $match->match_score }}%
                                </p>

                                <p>Reason: {{ $match->match_reason ?: 'N/A' }}</p>
                                <p>Status: {{ $match->status }}</p>
                            </div>

                            <div class="mt-4 flex items-center gap-3">

                                <a href="{{ route('ride-matches.show', [$tripRequest, $match]) }}"
                                   class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                    View
                                </a>

                                @if ($match->status === 'suggested')

                                    <form action="{{ route('ride-matches.accept', [$tripRequest, $match]) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="text-green-600 hover:text-green-800 flex items-center gap-1">
                                            Accept
                                        </button>
                                    </form>

                                    <form action="{{ route('ride-matches.reject', [$tripRequest, $match]) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 flex items-center gap-1">
                                            Reject
                                        </button>
                                    </form>

                                @endif
                            </div>

                        </div>
                    @empty
                        <p class="text-gray-500">No matches found. Generate matches first.</p>
                    @endforelse

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
