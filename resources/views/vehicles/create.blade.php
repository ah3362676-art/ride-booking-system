<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white flex items-center gap-2">
            ➕ Add New Vehicle
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white rounded-3xl shadow-lg p-8">

                <h3 class="text-2xl font-bold mb-6 flex items-center gap-2">
                    🚗 Vehicle Information
                </h3>

                <form action="{{ route('vehicles.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Brand -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-2">
                            🏷 Brand
                        </label>

                        <input type="text" name="brand" value="{{ old('brand') }}"
                            class="w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 p-3 shadow-sm">

                        @error('brand')
                            <p class="text-sm text-red-500 mt-1">❌ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Model -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-2">
                            🚘 Model
                        </label>

                        <input type="text" name="model" value="{{ old('model') }}"
                            class="w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 p-3 shadow-sm">

                        @error('model')
                            <p class="text-sm text-red-500 mt-1">❌ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-2">
                            🎨 Color
                        </label>

                        <input type="text" name="color" value="{{ old('color') }}"
                            class="w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 p-3 shadow-sm">

                        @error('color')
                            <p class="text-sm text-red-500 mt-1">❌ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Plate Number -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-2">
                            🔢 Plate Number
                        </label>

                        <input type="text" name="plate_number" value="{{ old('plate_number') }}"
                            class="w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 p-3 shadow-sm">

                        @error('plate_number')
                            <p class="text-sm text-red-500 mt-1">❌ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Seats -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-2">
                            💺 Seats Count
                        </label>

                        <input type="number" name="seats_count" value="{{ old('seats_count') }}"
                            class="w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 p-3 shadow-sm">

                        @error('seats_count')
                            <p class="text-sm text-red-500 mt-1">❌ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active -->
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active"
                            class="w-4 h-4 text-green-500"
                            value="1" @checked(old('is_active', true))>

                        <label for="is_active" class="text-sm text-gray-700 flex items-center gap-2">
                            ⚡ Active Vehicle
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-3 pt-4">

                        <button type="submit"
                            class="bg-black text-white px-6 py-3 rounded-2xl hover:bg-gray-800 transition flex items-center gap-2">
                            💾 Save Vehicle
                        </button>

                        <a href="{{ route('vehicles.index') }}"
                            class="bg-gray-200 text-gray-700 px-6 py-3 rounded-2xl hover:bg-gray-300 transition flex items-center gap-2">
                            ↩️ Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
