<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            رحلاتي
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Add Trip --}}
            <div class="mb-4">
                <a href="{{ route('trips.create') }}"
                   class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    إضافة رحلة جديدة
                </a>
            </div>

            {{-- Trips List --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @forelse ($trips as $trip)
                        <div class="mb-6 rounded-lg border p-4">

                            {{-- Trip Info --}}
                            <h3 class="text-lg font-bold text-gray-800">
                                {{ $trip->start_address }} → {{ $trip->end_address }}
                            </h3>

                            <div class="mt-2 space-y-1 text-sm text-gray-600">
                                <p>العربية: {{ $trip->vehicle?->brand }} - {{ $trip->vehicle?->model }}</p>
                                <p>ميعاد الانطلاق: {{ $trip->departure_time?->format('Y-m-d h:i A') }}</p>
                                <p>المقاعد المتاحة: {{ $trip->available_seats }}</p>
                                <p>السعر: {{ number_format($trip->price_per_seat, 2) }}</p>
                                <p>الحالة: {{ $trip->status }}</p>
                            </div>

                            {{-- Actions --}}
                            <div class="mt-4 flex items-center gap-3">

                                <a href="{{ route('trips.show', $trip) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                    عرض
                                </a>

                                <a href="{{ route('trips.edit', $trip) }}"
                                   class="text-yellow-600 hover:text-yellow-800">
                                    تعديل
                                </a>

                                {{-- 💬 Chat Button --}}
                                <a href="{{ route('chat.show', $trip->id) }}"
                                   class="text-green-600 hover:text-green-800">
                                    فتح الشات
                                </a>

                                <form action="{{ route('trips.destroy', $trip) }}" method="POST"
                                      onsubmit="return confirm('هل أنت متأكد من حذف الرحلة؟')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800">
                                        حذف
                                    </button>
                                </form>

                            </div>

                        </div>
                    @empty
                        <p class="text-gray-500">لا توجد رحلات حتى الآن.</p>
                    @endforelse

                    {{-- Pagination --}}
                    <div class="mt-6">
                        {{ $trips->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
