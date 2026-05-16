<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">
            Dashboard
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

            {{-- Welcome Section --}}
            <div class="bg-black text-white rounded-3xl p-6 shadow-lg">

                <h3 class="text-2xl font-bold">
                    Welcome back, {{ auth()->user()->name }} 👋
                </h3>

                <p class="text-gray-300 mt-2">
                    Here is your dashboard overview
                </p>

            </div>

            {{-- Info Cards --}}
            <div class="grid md:grid-cols-3 gap-6">

                <div class="bg-white rounded-3xl p-6 shadow hover:shadow-xl transition">
                    <h4 class="text-gray-500">Email</h4>
                    <p class="text-lg font-bold mt-2">
                        {{ auth()->user()->email }}
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow hover:shadow-xl transition">
                    <h4 class="text-gray-500">Phone</h4>
                    <p class="text-lg font-bold mt-2">
                        {{ auth()->user()->phone ?? 'Not set' }}
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow hover:shadow-xl transition">
                    <h4 class="text-gray-500">Account Type</h4>
                    <p class="text-lg font-bold mt-2 text-green-600">
                        {{ auth()->user()->role->value }}
                    </p>
                </div>

            </div>

            {{-- Quick Actions --}}
            <div class="bg-white rounded-3xl p-6 shadow">

                <h3 class="text-xl font-bold mb-4">
                    Quick Actions
                </h3>

                <div class="grid md:grid-cols-3 gap-4">

                    <a href="{{ route('trips.index') }}"
                       class="bg-black text-white text-center py-3 rounded-2xl hover:bg-gray-800 transition">
                        Trips
                    </a>

                    <a href="{{ route('vehicles.index') }}"
                       class="bg-green-500 text-white text-center py-3 rounded-2xl hover:bg-green-600 transition">
                        Vehicles
                    </a>

                    <a href="{{ route('trip-requests.index') }}"
                       class="bg-gray-900 text-white text-center py-3 rounded-2xl hover:bg-black transition">
                        Requests
                    </a>

                </div>

            </div>

            {{-- Future Note --}}
            <div class="text-center text-gray-500 text-sm">
                Coming soon: live trips, earnings, analytics & real-time updates 🚀
            </div>

        </div>

    </div>

</x-app-layout>
