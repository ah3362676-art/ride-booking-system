<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">
            Edit Trip
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white rounded-3xl shadow-lg p-8">

                <h3 class="text-2xl font-bold mb-6">
                    Update Trip Details
                </h3>

                <form action="{{ route('trips.update', $trip) }}" method="POST" class="space-y-6">

                    @csrf
                    @method('PUT')

                    <!-- Vehicle -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Vehicle
                        </label>

                        <select name="vehicle_id"
                            class="w-full rounded-2xl border-gray-200 p-3 shadow-sm">

                            <option value="">Select vehicle</option>

                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}"
                                    @selected(old('vehicle_id', $trip->vehicle_id) == $vehicle->id)>
                                    {{ $vehicle->brand }} - {{ $vehicle->model }} ({{ $vehicle->plate_number }})
                                </option>
                            @endforeach

                        </select>

                        @error('vehicle_id')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Route -->
                    <div class="grid md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Start Address
                            </label>

                            <input type="text" name="start_address"
                                value="{{ old('start_address', $trip->start_address) }}"
                                class="w-full rounded-2xl border-gray-200 p-3 shadow-sm">

                            @error('start_address')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                End Address
                            </label>

                            <input type="text" name="end_address"
                                value="{{ old('end_address', $trip->end_address) }}"
                                class="w-full rounded-2xl border-gray-200 p-3 shadow-sm">

                            @error('end_address')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Coordinates -->
                    <div class="grid md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Start Coordinates
                            </label>

                            <div class="grid grid-cols-2 gap-2">
                                <input type="text" name="start_lat"
                                    value="{{ old('start_lat', $trip->start_lat) }}"
                                    placeholder="Lat"
                                    class="rounded-2xl border-gray-200 p-3 shadow-sm">

                                <input type="text" name="start_lng"
                                    value="{{ old('start_lng', $trip->start_lng) }}"
                                    placeholder="Lng"
                                    class="rounded-2xl border-gray-200 p-3 shadow-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                End Coordinates
                            </label>

                            <div class="grid grid-cols-2 gap-2">
                                <input type="text" name="end_lat"
                                    value="{{ old('end_lat', $trip->end_lat) }}"
                                    placeholder="Lat"
                                    class="rounded-2xl border-gray-200 p-3 shadow-sm">

                                <input type="text" name="end_lng"
                                    value="{{ old('end_lng', $trip->end_lng) }}"
                                    placeholder="Lng"
                                    class="rounded-2xl border-gray-200 p-3 shadow-sm">
                            </div>
                        </div>

                    </div>

                    <!-- Time -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Departure Time
                        </label>

                        <input type="datetime-local" name="departure_time"
                            value="{{ old('departure_time', $trip->departure_time?->format('Y-m-d\TH:i')) }}"
                            class="w-full rounded-2xl border-gray-200 p-3 shadow-sm">

                        @error('departure_time')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Seats + Price -->
                    <div class="grid md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Available Seats
                            </label>

                            <input type="number" name="available_seats"
                                value="{{ old('available_seats', $trip->available_seats) }}"
                                class="w-full rounded-2xl border-gray-200 p-3 shadow-sm">

                            @error('available_seats')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Price per Seat
                            </label>

                            <input type="number" step="0.01" name="price_per_seat"
                                value="{{ old('price_per_seat', $trip->price_per_seat) }}"
                                class="w-full rounded-2xl border-gray-200 p-3 shadow-sm">

                            @error('price_per_seat')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Status
                        </label>

                        <select name="status"
                            class="w-full rounded-2xl border-gray-200 p-3 shadow-sm">

                            @foreach (['scheduled','in_progress','completed','cancelled'] as $status)
                                <option value="{{ $status }}"
                                    @selected(old('status', $trip->status) === $status)>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach

                        </select>

                        @error('status')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Notes
                        </label>

                        <textarea name="notes" rows="4"
                            class="w-full rounded-2xl border-gray-200 p-3 shadow-sm">{{ old('notes', $trip->notes) }}</textarea>

                        @error('notes')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-3 pt-4">

                        <button type="submit"
                            class="bg-black text-white px-6 py-3 rounded-2xl hover:bg-gray-800 transition">
                            Update Trip
                        </button>

                        <a href="{{ route('trips.index') }}"
                            class="bg-gray-200 text-gray-700 px-6 py-3 rounded-2xl hover:bg-gray-300 transition">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
