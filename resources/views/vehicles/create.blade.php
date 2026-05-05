<x-app-layout>
    <x-slot name="header">
        {{-- عنوان الصفحة --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            إضافة مركبة
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('vehicles.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="brand" class="block text-sm font-medium text-gray-700">الشركة المصنعة</label>
                            <input type="text" name="brand" id="brand" value="{{ old('brand') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('brand')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="model" class="block text-sm font-medium text-gray-700">الموديل</label>
                            <input type="text" name="model" id="model" value="{{ old('model') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('model')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="color" class="block text-sm font-medium text-gray-700">اللون</label>
                            <input type="text" name="color" id="color" value="{{ old('color') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('color')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="plate_number" class="block text-sm font-medium text-gray-700">رقم اللوحة</label>
                            <input type="text" name="plate_number" id="plate_number" value="{{ old('plate_number') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('plate_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="seats_count" class="block text-sm font-medium text-gray-700">عدد المقاعد</label>
                            <input type="number" name="seats_count" id="seats_count" value="{{ old('seats_count') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('seats_count')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                   @checked(old('is_active', true))>
                            <label for="is_active" class="text-sm text-gray-700">مفعلة</label>
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit"
                                    class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                                حفظ
                            </button>

                            <a href="{{ route('vehicles.index') }}"
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
