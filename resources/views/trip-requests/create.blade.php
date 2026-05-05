<x-app-layout>
    <x-slot name="header">
        {{-- عنوان الصفحة --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            إنشاء طلب رحلة
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('trip-requests.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="start_address" class="block text-sm font-medium text-gray-700">عنوان البداية</label>
                            <input type="text" name="start_address" id="start_address" value="{{ old('start_address') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('start_address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label for="start_lat" class="block text-sm font-medium text-gray-700">خط عرض البداية</label>
                                <input type="text" name="start_lat" id="start_lat" value="{{ old('start_lat') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('start_lat')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="start_lng" class="block text-sm font-medium text-gray-700">خط طول البداية</label>
                                <input type="text" name="start_lng" id="start_lng" value="{{ old('start_lng') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('start_lng')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="end_address" class="block text-sm font-medium text-gray-700">عنوان النهاية</label>
                            <input type="text" name="end_address" id="end_address" value="{{ old('end_address') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('end_address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label for="end_lat" class="block text-sm font-medium text-gray-700">خط عرض النهاية</label>
                                <input type="text" name="end_lat" id="end_lat" value="{{ old('end_lat') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('end_lat')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_lng" class="block text-sm font-medium text-gray-700">خط طول النهاية</label>
                                <input type="text" name="end_lng" id="end_lng" value="{{ old('end_lng') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('end_lng')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="requested_seats" class="block text-sm font-medium text-gray-700">عدد المقاعد المطلوبة</label>
                            <input type="number" name="requested_seats" id="requested_seats"
                                   value="{{ old('requested_seats', 1) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('requested_seats')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">ملاحظات</label>
                            <textarea name="notes" id="notes" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit"
                                    class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                                حفظ
                            </button>

                            <a href="{{ route('trip-requests.index') }}"
                               class="rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">
                                رجوع
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
