<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">
            My Vehicles
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

            {{-- Add Button --}}
            <div class="flex justify-end">
                <a href="{{ route('vehicles.create') }}"
                   class="bg-black text-white px-5 py-3 rounded-2xl hover:bg-gray-800 transition">
                    + Add Vehicle
                </a>
            </div>

            {{-- Vehicles Grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse ($vehicles as $vehicle)

                    <div class="bg-white rounded-3xl shadow hover:shadow-xl transition p-6">

                        {{-- Title --}}
                        <h3 class="text-xl font-bold text-gray-800">
                            {{ $vehicle->brand }} {{ $vehicle->model }}
                        </h3>

                        {{-- Info --}}
                        <div class="mt-4 space-y-2 text-sm text-gray-600">

                            <p>
                                <span class="font-semibold">Color:</span>
                                {{ $vehicle->color }}
                            </p>

                            <p>
                                <span class="font-semibold">Plate:</span>
                                {{ $vehicle->plate_number }}
                            </p>

                            <p>
                                <span class="font-semibold">Seats:</span>
                                {{ $vehicle->seats_count }}
                            </p>

                            <p>
                                <span class="font-semibold">Status:</span>

                                @if ($vehicle->is_active)
                                    <span class="text-green-600 font-bold">Active</span>
                                @else
                                    <span class="text-red-600 font-bold">Inactive</span>
                                @endif
                            </p>

                        </div>

                        {{-- Actions --}}
                        <div class="mt-6 flex items-center justify-between">

                            <a href="{{ route('vehicles.show', $vehicle) }}"
                               class="text-blue-600 hover:text-blue-800">
                                View
                            </a>

                            <a href="{{ route('vehicles.edit', $vehicle) }}"
                               class="text-yellow-600 hover:text-yellow-800">
                                Edit
                            </a>

                            <form action="{{ route('vehicles.destroy', $vehicle) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this vehicle?')">
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
                        No vehicles found. Add your first vehicle 🚗
                    </div>

                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $vehicles->links() }}
            </div>

        </div>

    </div>

</x-app-layout>
