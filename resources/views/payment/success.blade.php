<x-app-layout>

    <div class="max-w-xl mx-auto py-20">

        <div class="bg-white shadow rounded-2xl p-8 text-center">

            <h1 class="text-3xl font-bold text-green-600 mb-4">
                Payment Successful ✅
            </h1>

            <p class="text-gray-600">
                Your booking has been paid successfully.
            </p>

            <a href="{{ route('my-trips') }}"
               class="inline-block mt-6 px-6 py-3 bg-black text-white rounded-xl">
                My Trips
            </a>

        </div>

    </div>

</x-app-layout>
