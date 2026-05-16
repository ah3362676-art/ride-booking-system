<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">
            🚗 Create Trip Request
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white rounded-3xl shadow-lg p-8 space-y-6">

                {{-- Title --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">
                        Request a Ride
                    </h3>
                    <p class="text-gray-500 text-sm mt-1">
                        Fill your trip details and we’ll match you instantly
                    </p>
                </div>

                <form action="{{ route('trip-requests.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Start --}}
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">
                            📍 Start Location
                        </label>

                        <input type="text"
                               name="start_address"
                               value="{{ old('start_address') }}"
                               placeholder="Enter start address"
                               class="w-full rounded-2xl border-gray-200 focus:ring-2 focus:ring-black p-3">

                        @error('start_address')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        <div class="grid md:grid-cols-2 gap-4">
                            <input type="text"
                                   name="start_lat"
                                   value="{{ old('start_lat') }}"
                                   placeholder="Latitude"
                                   class="rounded-2xl border-gray-200 p-3">

                            <input type="text"
                                   name="start_lng"
                                   value="{{ old('start_lng') }}"
                                   placeholder="Longitude"
                                   class="rounded-2xl border-gray-200 p-3">
                        </div>

                        @error('start_lat')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                        @error('start_lng')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- End --}}
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">
                            🎯 Destination
                        </label>

                        <input type="text"
                               name="end_address"
                               value="{{ old('end_address') }}"
                               placeholder="Enter destination"
                               class="w-full rounded-2xl border-gray-200 focus:ring-2 focus:ring-black p-3">

                        @error('end_address')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        <div class="grid md:grid-cols-2 gap-4">
                            <input type="text"
                                   name="end_lat"
                                   value="{{ old('end_lat') }}"
                                   placeholder="Latitude"
                                   class="rounded-2xl border-gray-200 p-3">

                            <input type="text"
                                   name="end_lng"
                                   value="{{ old('end_lng') }}"
                                   placeholder="Longitude"
                                   class="rounded-2xl border-gray-200 p-3">
                        </div>
                    </div>

                    {{-- Seats --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700">
                            👤 Seats Required
                        </label>

                        <input type="number"
                               name="requested_seats"
                               value="{{ old('requested_seats', 1) }}"
                               min="1"
                               class="w-full rounded-2xl border-gray-200 p-3 mt-2">

                        @error('requested_seats')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Notes --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700">
                            📝 Notes
                        </label>

                        <textarea name="notes"
                                  rows="4"
                                  placeholder="Optional instructions..."
                                  class="w-full rounded-2xl border-gray-200 p-3 mt-2">{{ old('notes') }}</textarea>

                        @error('notes')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Errors global --}}
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-2xl text-sm">
                            Please fix the errors below.
                        </div>
                    @endif

                    {{-- Actions --}}
                    <div class="flex items-center gap-3 pt-2">

                        <button type="submit"
                                class="bg-black text-white px-6 py-3 rounded-2xl hover:bg-gray-800 transition">
                            Submit Request
                        </button>

                        <a href="{{ route('trip-requests.index') }}"
                           class="bg-gray-200 text-gray-700 px-6 py-3 rounded-2xl hover:bg-gray-300 transition">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
