<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">
            Create Trip Request
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white rounded-3xl shadow-lg p-8">

                <h3 class="text-2xl font-bold mb-6">
                    Trip Request Details
                </h3>

                <form action="{{ route('trip-requests.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- START ADDRESS --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Start Address
                        </label>

                        <input type="text" name="start_address"
                               value="{{ old('start_address') }}"
                               class="w-full rounded-2xl border-gray-200 p-3 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        @error('start_address')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- START COORDINATES --}}
                    <div class="grid md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Start Latitude
                            </label>

                            <input type="number" step="any" name="start_lat"
                                   value="{{ old('start_lat') }}"
                                   class="w-full rounded-2xl border-gray-200 p-3 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            @error('start_lat')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Start Longitude
                            </label>

                            <input type="number" step="any" name="start_lng"
                                   value="{{ old('start_lng') }}"
                                   class="w-full rounded-2xl border-gray-200 p-3 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            @error('start_lng')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- END ADDRESS --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            End Address
                        </label>

                        <input type="text" name="end_address"
                               value="{{ old('end_address') }}"
                               class="w-full rounded-2xl border-gray-200 p-3 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        @error('end_address')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- END COORDINATES --}}
                    <div class="grid md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                End Latitude
                            </label>

                            <input type="number" step="any" name="end_lat"
                                   value="{{ old('end_lat') }}"
                                   class="w-full rounded-2xl border-gray-200 p-3 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            @error('end_lat')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                End Longitude
                            </label>

                            <input type="number" step="any" name="end_lng"
                                   value="{{ old('end_lng') }}"
                                   class="w-full rounded-2xl border-gray-200 p-3 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            @error('end_lng')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- SEATS --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Requested Seats
                        </label>

                        <input type="number" name="requested_seats"
                               value="{{ old('requested_seats', 1) }}"
                               class="w-full rounded-2xl border-gray-200 p-3 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        @error('requested_seats')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ACTIONS --}}
                    <div class="flex items-center gap-3 pt-4">

                        <button type="submit"
                                class="bg-black text-white px-6 py-3 rounded-2xl hover:bg-gray-800 transition">
                            Save Request
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
