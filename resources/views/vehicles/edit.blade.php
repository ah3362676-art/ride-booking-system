<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">
            Edit Vehicle
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white rounded-3xl shadow-lg p-8">

                <h3 class="text-2xl font-bold mb-6">
                    Update Vehicle Details
                </h3>

                <form action="{{ route('vehicles.update', $vehicle) }}" method="POST" class="space-y-5">

                    @csrf
                    @method('PUT')

                    <!-- Brand -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Brand
                        </label>

                        <input type="text" name="brand"
                            value="{{ old('brand', $vehicle->brand) }}"
                            class="w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 p-3 shadow-sm">

                        @error('brand')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Model -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Model
                        </label>

                        <input type="text" name="model"
                            value="{{ old('model', $vehicle->model) }}"
                            class="w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 p-3 shadow-sm">

                        @error('model')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Color
                        </label>

                        <input type="text" name="color"
                            value="{{ old('color', $vehicle->color) }}"
                            class="w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 p-3 shadow-sm">

                        @error('color')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Plate Number -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Plate Number
                        </label>

                        <input type="text" name="plate_number"
                            value="{{ old('plate_number', $vehicle->plate_number) }}"
                            class="w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 p-3 shadow-sm">

                        @error('plate_number')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Seats -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Seats Count
                        </label>

                        <input type="number" name="seats_count"
                            value="{{ old('seats_count', $vehicle->seats_count) }}"
                            class="w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 p-3 shadow-sm">

                        @error('seats_count')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active -->
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active"
                            value="1"
                            class="w-4 h-4 text-green-500"
                            @checked(old('is_active', $vehicle->is_active))>

                        <label for="is_active" class="text-sm text-gray-700">
                            Active Vehicle
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-3 pt-4">

                        <button type="submit"
                            class="bg-black text-white px-6 py-3 rounded-2xl hover:bg-gray-800 transition">
                            Update Vehicle
                        </button>

                        <a href="{{ route('vehicles.index') }}"
                            class="bg-gray-200 text-gray-700 px-6 py-3 rounded-2xl hover:bg-gray-300 transition">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
