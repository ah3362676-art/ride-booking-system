<x-welcome-layout>
    <div class="min-h-screen bg-black text-white overflow-x-hidden">

        <!-- HERO -->
        <section class="relative min-h-screen flex items-center">

            <!-- Background Glow -->
            <div class="absolute inset-0 overflow-hidden">

                <div class="absolute top-0 left-0 w-96 h-96 bg-green-500/20 blur-[120px] rounded-full"></div>

                <div class="absolute bottom-0 right-0 w-96 h-96 bg-green-500/10 blur-[120px] rounded-full"></div>

            </div>

            <div class="relative z-10 w-full max-w-7xl mx-auto px-6 py-20">

                <div class="grid lg:grid-cols-2 gap-20 items-center">

                    <!-- LEFT -->
                    <div>

                        <p class="text-green-500 font-semibold mb-5 uppercase tracking-[0.3em]">
                            Smart Ride Sharing
                        </p>

                        <h1 class="text-5xl md:text-7xl font-black leading-tight">

                            Go anywhere with

                            <span class="text-green-500 block mt-2">
                                Uber
                            </span>

                        </h1>

                        <p class="mt-8 text-lg md:text-xl text-gray-400 leading-9 max-w-2xl">
                            Book rides, share trips, chat with drivers,
                            and enjoy a modern ride-sharing experience
                            with secure payments and fast matching.
                        </p>

                        <!-- BUTTONS -->
                        <div class="mt-10 flex flex-wrap gap-5">

                            <a href="{{ route('register') }}"
                               class="bg-green-500 hover:bg-green-600 transition-all duration-300 px-8 py-4 rounded-2xl font-bold text-black text-lg shadow-lg shadow-green-500/20 hover:scale-105">

                                Get Started

                            </a>

                            <a href="{{ route('login') }}"
                               class="border border-gray-700 hover:border-green-500 hover:text-green-400 transition-all duration-300 px-8 py-4 rounded-2xl font-bold text-lg hover:scale-105">

                                Login

                            </a>

                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="flex justify-center lg:justify-end">

                        <div class="relative">

                            <!-- Glow -->
                            <div class="absolute inset-0 bg-green-500 blur-[100px] opacity-20 rounded-full"></div>

                            <!-- Card -->
                            <div class="relative bg-gray-900/90 backdrop-blur border border-gray-800 rounded-[32px] p-8 w-full max-w-sm shadow-2xl">

                                <!-- Top -->
                                <div class="flex items-center justify-between">

                                    <div>

                                        <p class="text-gray-400 text-sm">
                                            Available Drivers
                                        </p>

                                        <h3 class="text-5xl font-black mt-2">
                                            120+
                                        </h3>

                                    </div>

                                    <!-- ICON -->
                                    <div class="bg-green-500/20 p-5 rounded-3xl">

                                        <svg class="w-10 h-10 text-green-500"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M3 13l2-5h14l2 5m-1 0a2 2 0 11-4 0m-8 0a2 2 0 11-4 0m12 0H5" />
                                        </svg>

                                    </div>

                                </div>

                                <!-- STATS -->
                                <div class="mt-10 space-y-5">

                                    <div class="bg-black/70 border border-gray-800 rounded-2xl p-5">

                                        <div class="flex items-center gap-4">

                                            <div class="bg-green-500/20 p-3 rounded-xl">

                                                <svg class="w-6 h-6 text-green-500"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>

                                            </div>

                                            <div>

                                                <p class="text-sm text-gray-400">
                                                    Fast Matching
                                                </p>

                                                <p class="font-semibold text-lg">
                                                    Find rides instantly
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="bg-black/70 border border-gray-800 rounded-2xl p-5">

                                        <div class="flex items-center gap-4">

                                            <div class="bg-green-500/20 p-3 rounded-xl">

                                                <svg class="w-6 h-6 text-green-500"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M17 9V7a5 5 0 00-10 0v2m-2 0h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8a2 2 0 012-2z" />
                                                </svg>

                                            </div>

                                            <div>

                                                <p class="text-sm text-gray-400">
                                                    Secure Payments
                                                </p>

                                                <p class="font-semibold text-lg">
                                                    Safe transactions
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- FEATURES -->
        <section class="py-28 bg-gray-950">

            <div class="max-w-7xl mx-auto px-6">

                <div class="text-center mb-20">

                    <h2 class="text-4xl md:text-5xl font-black">
                        Why Choose Uber
                    </h2>

                    <p class="text-gray-400 mt-5 text-lg">
                        Everything you need for modern ride sharing.
                    </p>

                </div>

                <div class="grid md:grid-cols-3 gap-8">

                    <!-- CARD -->
                    <div class="bg-black border border-gray-800 rounded-3xl p-8 hover:border-green-500 hover:-translate-y-2 transition duration-300">

                        <div class="bg-green-500/20 w-16 h-16 rounded-2xl flex items-center justify-center mb-7">

                            <svg class="w-8 h-8 text-green-500"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>

                        </div>

                        <h3 class="text-2xl font-bold mb-4">
                            Fast Booking
                        </h3>

                        <p class="text-gray-400 leading-8">
                            Book trips instantly using smart ride matching technology.
                        </p>

                    </div>

                    <!-- CARD -->
                    <div class="bg-black border border-gray-800 rounded-3xl p-8 hover:border-green-500 hover:-translate-y-2 transition duration-300">

                        <div class="bg-green-500/20 w-16 h-16 rounded-2xl flex items-center justify-center mb-7">

                            <svg class="w-8 h-8 text-green-500"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" />
                            </svg>

                        </div>

                        <h3 class="text-2xl font-bold mb-4">
                            Safe Trips
                        </h3>

                        <p class="text-gray-400 leading-8">
                            Verified drivers and secure ride experiences for everyone.
                        </p>

                    </div>

                    <!-- CARD -->
                    <div class="bg-black border border-gray-800 rounded-3xl p-8 hover:border-green-500 hover:-translate-y-2 transition duration-300">

                        <div class="bg-green-500/20 w-16 h-16 rounded-2xl flex items-center justify-center mb-7">

                            <svg class="w-8 h-8 text-green-500"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M17 9V7a5 5 0 00-10 0v2m-2 0h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8a2 2 0 012-2z" />
                            </svg>

                        </div>

                        <h3 class="text-2xl font-bold mb-4">
                            Smart Payments
                        </h3>

                        <p class="text-gray-400 leading-8">
                            Secure and transparent payments with smooth booking flow.
                        </p>

                    </div>

                </div>

            </div>

        </section>

        <!-- FOOTER -->
        <footer class="border-t border-gray-800 py-8 bg-black">

            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">

                <h3 class="text-3xl font-black text-green-500">
                    Uber
                </h3>

                <p class="text-gray-500 text-sm">
                    © {{ date('Y') }} Uber Clone. All rights reserved.
                </p>

            </div>

        </footer>

    </div>

</x-welcome-layout>
