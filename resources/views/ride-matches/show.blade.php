<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            تفاصيل المطابقة
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-3">
                    <h3 class="text-xl font-bold text-gray-800">
                        {{ $rideMatch->trip?->start_address }} → {{ $rideMatch->trip?->end_address }}
                    </h3>

                    <p><span class="font-semibold">السائق:</span> {{ $rideMatch->trip?->driver?->name }}</p>
                    <p><span class="font-semibold">العربية:</span> {{ $rideMatch->trip?->vehicle?->brand }} - {{ $rideMatch->trip?->vehicle?->model }}</p>
                    <p><span class="font-semibold">رقم اللوحة:</span> {{ $rideMatch->trip?->vehicle?->plate_number }}</p>
                    <p><span class="font-semibold">ميعاد الانطلاق:</span> {{ $rideMatch->trip?->departure_time?->format('Y-m-d h:i A') }}</p>
                    <p><span class="font-semibold">المقاعد المتاحة:</span> {{ $rideMatch->trip?->available_seats }}</p>
                    <p><span class="font-semibold">السعر لكل مقعد:</span> {{ number_format($rideMatch->trip?->price_per_seat ?? 0, 2) }}</p>
                    <p><span class="font-semibold">درجة التطابق:</span> {{ $rideMatch->match_score }}%</p>
                    <p><span class="font-semibold">سبب المطابقة:</span> {{ $rideMatch->match_reason ?: 'لا يوجد' }}</p>
                    <p><span class="font-semibold">الحالة:</span> {{ $rideMatch->status }}</p>

                    <div class="pt-4">
                        <a href="{{ route('ride-matches.index', $tripRequest) }}"
                           class="rounded-lg bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                            رجوع
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
