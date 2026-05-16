<x-app-layout>
    @php
    $user = auth()->user();
@endphp

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

                      @if($user->role->isDriver())

                        <x-nav-link :href="route('vehicles.index')"
                                    :active="request()->routeIs('vehicles.*')"
                                    class="flex items-center gap-2 text-gray-800 hover:text-green-400 transition">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 13l2-5h14l2 5m-1 0a2 2 0 11-4 0m-8 0a2 2 0 11-4 0m12 0H5" />
                            </svg>

                            Vehicles
                        </x-nav-link>

                        <x-nav-link :href="route('trips.index')"
                                    :active="request()->routeIs('trips.*')"
                                    class="flex items-center gap-2 text-gray-800 hover:text-green-400 transition">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 20l-5-2V5l5 2 6-2 5 2v13l-5-2-6 2z" />
                            </svg>

                            Trips
                        </x-nav-link>

                    @endif

                    @if($user->role->isRider())

                        <x-nav-link :href="route('trip-requests.index')"
                                    :active="request()->routeIs('trip-requests.*')"
                                    class="flex items-center gap-2 text-gray-800 hover:text-green-400 transition">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 12H8m0 0l4-4m-4 4l4 4" />
                            </svg>

                            Requests
                        </x-nav-link>

                        <x-nav-link :href="route('my-trips')"
                                    :active="request()->routeIs('my-trips')"
                                    class="flex items-center gap-2 text-gray-800 hover:text-green-400 transition">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>

                            My Trips
                        </x-nav-link>

                    @endif

                </div>

            </div>

            {{-- Future Note --}}
            <div class="text-center text-gray-500 text-sm">
                Coming soon: live trips, earnings, analytics & real-time updates 🚀
            </div>

        </div>

    </div>

</x-app-layout>
