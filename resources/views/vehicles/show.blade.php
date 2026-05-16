<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">
            Vehicle Details
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-3xl mx-auto px-4">

            {{-- Main Card --}}
            <div class="bg-white rounded-3xl shadow-lg p-8 space-y-6">

                {{-- Title --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">
                        {{ $vehicle->brand }} {{ $vehicle->model }}
                    </h3>

                    <p class="text-gray-500 mt-1">
                        Vehicle full information overview
                    </p>
                </div>

                {{-- Info Grid --}}
                <div class="grid md:grid-cols-2 gap-4 text-sm">

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-gray-500">Color</p>
                        <p class="font-bold text-gray-800">{{ $vehicle->color }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-gray-500">Plate Number</p>
                        <p class="font-bold text-gray-800">{{ $vehicle->plate_number }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-gray-500">Seats</p>
                        <p class="font-bold text-gray-800">{{ $vehicle->seats_count }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-gray-500">Status</p>

                        @if ($vehicle->is_active)
                            <span class="inline-block mt-1 text-green-600 font-bold">
                                Active
                            </span>
                        @else
                            <span class="inline-block mt-1 text-red-500 font-bold">
                                Inactive
                            </span>
                        @endif
                    </div>

                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-3 pt-4">

                    <a href="{{ route('vehicles.edit', $vehicle) }}"
                        class="bg-black text-white px-6 py-3 rounded-2xl hover:bg-gray-800 transition">
                        Edit Vehicle
                    </a>

                    <a href="{{ route('vehicles.index') }}"
                        class="bg-gray-200 text-gray-700 px-6 py-3 rounded-2xl hover:bg-gray-300 transition">
                        Back
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
