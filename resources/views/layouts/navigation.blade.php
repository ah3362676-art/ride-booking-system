@php
    $user = auth()->user();
@endphp

<nav x-data="{ open: false }" class="bg-black text-white border-b border-gray-800">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between h-16">

            <!-- LEFT SIDE -->
            <div class="flex items-center gap-10">

                <!-- Logo -->
                <a href="{{ route('dashboard') }}"
                   class="text-2xl font-bold text-green-500">
                    Uber
                </a>

                <!-- Desktop Links -->
                <div class="hidden md:flex items-center space-x-6">

                    <!-- Dashboard -->
                    <x-nav-link :href="route('dashboard')"
                                :active="request()->routeIs('dashboard')"
                                class="flex items-center gap-2 text-gray-300 hover:text-green-400 transition">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>

                        Dashboard
                    </x-nav-link>

                    {{-- DRIVER ONLY --}}
                    @if($user->role->isDriver())

                        <!-- Vehicles -->
                        <x-nav-link :href="route('vehicles.index')"
                                    :active="request()->routeIs('vehicles.*')"
                                    class="flex items-center gap-2 text-gray-300 hover:text-green-400 transition">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M3 13l2-5h14l2 5m-1 0a2 2 0 11-4 0m-8 0a2 2 0 11-4 0m12 0H5" />
                            </svg>

                            Vehicles
                        </x-nav-link>

                        <!-- Trips -->
                        <x-nav-link :href="route('trips.index')"
                                    :active="request()->routeIs('trips.*')"
                                    class="flex items-center gap-2 text-gray-300 hover:text-green-400 transition">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 20l-5-2V5l5 2 6-2 5 2v13l-5-2-6 2z" />
                            </svg>

                            Trips
                        </x-nav-link>

                    @endif

                    {{-- RIDER ONLY --}}
                    @if($user->role->isRider())

                        <!-- Requests -->
                        <x-nav-link :href="route('trip-requests.index')"
                                    :active="request()->routeIs('trip-requests.*')"
                                    class="flex items-center gap-2 text-gray-300 hover:text-green-400 transition">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M16 12H8m0 0l4-4m-4 4l4 4" />
                            </svg>

                            Requests
                        </x-nav-link>

                       <!-- My Trips -->
                <x-nav-link :href="route('my-trips')"
                            :active="request()->routeIs('my-trips')"
                            class="flex items-center gap-2 text-gray-300 hover:text-green-400 transition">

                    <svg class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>

                    My Trips
                </x-nav-link>
                    @endif

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="hidden md:flex items-center space-x-4">

                <div class="text-sm text-gray-400">
                    {{ $user->name }}
                </div>

                <!-- Dropdown -->
                <div class="relative" x-data="{ dropdown: false }">

                    <button @click="dropdown = !dropdown"
                            class="bg-gray-900 px-4 py-2 rounded-xl hover:bg-gray-800 transition">
                        Menu
                    </button>

                    <div x-show="dropdown"
                         @click.away="dropdown = false"
                         class="absolute right-0 mt-2 w-48 bg-white text-black rounded-xl shadow-lg overflow-hidden z-50">

                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-2 hover:bg-gray-100">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-500">
                                Logout
                            </button>
                        </form>

                    </div>

                </div>

            </div>

            <!-- Mobile Button -->
            <div class="md:hidden flex items-center">

                <button @click="open = !open" class="text-gray-300">

                    <svg class="h-6 w-6"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path :class="{ 'hidden': open }"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': !open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>

            </div>

        </div>

    </div>

    <!-- MOBILE MENU -->
    <div :class="open ? 'block' : 'hidden'"
         class="md:hidden bg-black border-t border-gray-800">

        <div class="px-4 py-3 space-y-3">

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-2 text-gray-300 hover:text-green-400">
                Dashboard
            </a>

            {{-- DRIVER --}}
            @if($user->role->isDriver())

                <a href="{{ route('vehicles.index') }}"
                   class="flex items-center gap-2 text-gray-300 hover:text-green-400">
                    Vehicles
                </a>

                <a href="{{ route('trips.index') }}"
                   class="flex items-center gap-2 text-gray-300 hover:text-green-400">
                    Trips
                </a>

            @endif

            {{-- RIDER --}}
            @if($user->role->isRider())

                <a href="{{ route('trip-requests.index') }}"
                   class="flex items-center gap-2 text-gray-300 hover:text-green-400">
                    Requests
                </a>

                <a href="{{ route('my-trips') }}"
                   class="flex items-center gap-2 text-gray-300 hover:text-green-400">
                    My Trips
                </a>

            @endif

            <div class="border-t border-gray-800 pt-3 mt-3">

                <div class="text-gray-400 text-sm">
                    {{ $user->email }}
                </div>

                <form method="POST"
                      action="{{ route('logout') }}"
                      class="mt-2">

                    @csrf

                    <button class="text-red-400 hover:text-red-300">
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </div>

</nav>
