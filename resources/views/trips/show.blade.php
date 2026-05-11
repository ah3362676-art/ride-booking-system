<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            تفاصيل الرحلة
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-3">

                    <h3 class="text-xl font-bold text-gray-800">
                        {{ $trip->start_address }} → {{ $trip->end_address }}
                    </h3>

                    <p><span class="font-semibold">العربية:</span> {{ $trip->vehicle?->brand }} - {{ $trip->vehicle?->model }}</p>
                    <p><span class="font-semibold">رقم اللوحة:</span> {{ $trip->vehicle?->plate_number }}</p>
                    <p><span class="font-semibold">وقت الانطلاق:</span> {{ $trip->departure_time?->format('Y-m-d h:i A') }}</p>
                    <p><span class="font-semibold">عدد المقاعد:</span> {{ $trip->available_seats }}</p>
                    <p><span class="font-semibold">السعر لكل مقعد:</span> {{ number_format($trip->price_per_seat, 2) }}</p>
                    <p><span class="font-semibold">الحالة:</span> {{ $trip->status }}</p>

                    <div>
                        <p class="font-semibold">ملاحظات:</p>
                        <p class="text-sm text-gray-600">{{ $trip->notes ?: 'لا توجد ملاحظات' }}</p>
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('trips.edit', $trip) }}"
                           class="rounded-lg bg-yellow-500 px-4 py-2 text-white hover:bg-yellow-600">
                            تعديل
                        </a>

                        <a href="{{ route('trips.index') }}"
                           class="ml-2 rounded-lg bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                            رجوع
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
