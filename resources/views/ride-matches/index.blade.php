<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            المطابقات المقترحة
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 rounded-lg bg-white p-4 shadow-sm">
                <h3 class="text-lg font-bold text-gray-800">
                    الطلب: {{ $tripRequest->start_address }} → {{ $tripRequest->end_address }}
                </h3>
                <p class="text-sm text-gray-600 mt-1">
                    عدد المقاعد المطلوبة: {{ $tripRequest->requested_seats }}
                </p>

                <form action="{{ route('ride-matches.generate', $tripRequest) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                        توليد المطابقات
                    </button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse ($matches as $match)
                        <div class="mb-4 rounded-lg border p-4">
                            <h3 class="text-lg font-bold text-gray-800">
                                {{ $match->trip?->start_address }} → {{ $match->trip?->end_address }}
                            </h3>

                            <div class="mt-2 space-y-1 text-sm text-gray-600">
                                <p>السائق: {{ $match->trip?->driver?->name }}</p>
                                <p>العربية: {{ $match->trip?->vehicle?->brand }} - {{ $match->trip?->vehicle?->model }}</p>
                                <p>المقاعد المتاحة: {{ $match->trip?->available_seats }}</p>
                                <p>السعر لكل مقعد: {{ number_format($match->trip?->price_per_seat ?? 0, 2) }}</p>
                                <p>درجة التطابق: {{ $match->match_score }}%</p>
                                <p>سبب المطابقة: {{ $match->match_reason ?: 'لا يوجد' }}</p>
                                <p>الحالة: {{ $match->status }}</p>
                            </div>

                            <div class="mt-4 flex items-center gap-3">
                                <a href="{{ route('ride-matches.show', [$tripRequest, $match]) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                    عرض
                                </a>

                                @if ($match->status === 'suggested')
                                    <form action="{{ route('ride-matches.accept', [$tripRequest, $match]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800">
                                            قبول
                                        </button>
                                    </form>

                                    <form action="{{ route('ride-matches.reject', [$tripRequest, $match]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            رفض
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">لا توجد مطابقات حتى الآن. اضغط على "توليد المطابقات".</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
