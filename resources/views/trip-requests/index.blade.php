<x-app-layout>
    <x-slot name="header">
        {{-- عنوان الصفحة --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            طلبات رحلاتي
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- رسالة نجاح --}}
            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('trip-requests.create') }}"
                   class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    طلب رحلة جديدة
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse ($tripRequests as $request)
                        <div class="mb-4 rounded-lg border p-4">
                            <h3 class="text-lg font-bold text-gray-800">
                                {{ $request->start_address }} → {{ $request->end_address }}
                            </h3>

                            <div class="mt-2 space-y-1 text-sm text-gray-600">
                                <p>عدد المقاعد المطلوبة: {{ $request->requested_seats }}</p>
                                <p>الحالة: {{ $request->status }}</p>

                                @if ($request->matchedTrip)
                                    <p>
                                        الرحلة المطابقة:
                                        {{ $request->matchedTrip->start_address }}
                                        →
                                        {{ $request->matchedTrip->end_address }}
                                    </p>
                                @endif
                            </div>

                            <div class="mt-4 flex items-center gap-3">
                                <a href="{{ route('trip-requests.show', $request) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                    عرض
                                </a>

                                <a href="{{ route('trip-requests.edit', $request) }}"
                                   class="text-yellow-600 hover:text-yellow-800">
                                    تعديل
                                </a>

                                <form action="{{ route('trip-requests.destroy', $request) }}" method="POST"
                                      onsubmit="return confirm('هل أنت متأكد من حذف الطلب؟')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">لا توجد طلبات رحلات حتى الآن.</p>
                    @endforelse

                    <div class="mt-6">
                        {{ $tripRequests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
