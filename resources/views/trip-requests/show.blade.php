<x-app-layout>
    <x-slot name="header">
        {{-- عنوان الصفحة --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            تفاصيل طلب الرحلة
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-3">
                    <h3 class="text-xl font-bold text-gray-800">
                        {{ $tripRequest->start_address }} → {{ $tripRequest->end_address }}
                    </h3>

                    <p><span class="font-semibold">عدد المقاعد المطلوبة:</span> {{ $tripRequest->requested_seats }}</p>
                    <p><span class="font-semibold">الحالة:</span> {{ $tripRequest->status }}</p>

                    <div>
                        <p class="font-semibold">عنوان البداية:</p>
                        <p class="text-sm text-gray-600">{{ $tripRequest->start_address }}</p>
                        <p class="text-xs text-gray-500">Lat: {{ $tripRequest->start_lat }} / Lng: {{ $tripRequest->start_lng }}</p>
                    </div>

                    <div>
                        <p class="font-semibold">عنوان النهاية:</p>
                        <p class="text-sm text-gray-600">{{ $tripRequest->end_address }}</p>
                        <p class="text-xs text-gray-500">Lat: {{ $tripRequest->end_lat }} / Lng: {{ $tripRequest->end_lng }}</p>
                    </div>

                    <div>
                        <p class="font-semibold">ملاحظات:</p>
                        <p class="text-sm text-gray-600">{{ $tripRequest->notes ?: 'لا توجد ملاحظات' }}</p>
                    </div>

                    @if ($tripRequest->matchedTrip)
                        <div class="rounded-lg bg-blue-50 p-4">
                            <p class="font-semibold text-blue-800">تم العثور على رحلة مطابقة</p>
                            <p class="text-sm text-blue-700">
                                {{ $tripRequest->matchedTrip->start_address }}
                                →
                                {{ $tripRequest->matchedTrip->end_address }}
                            </p>
                        </div>
                    @endif

                    <div class="pt-4">
                        <a href="{{ route('trip-requests.edit', $tripRequest) }}"
                           class="rounded-lg bg-yellow-500 px-4 py-2 text-white hover:bg-yellow-600">
                            تعديل
                        </a>

                        <a href="{{ route('trip-requests.index') }}"
                           class="ml-2 rounded-lg bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                            رجوع
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
