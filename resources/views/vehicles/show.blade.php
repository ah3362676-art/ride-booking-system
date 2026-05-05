<x-app-layout>
    <x-slot name="header">
        {{-- عنوان الصفحة --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            تفاصيل المركبة
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-3">
                    <h3 class="text-xl font-bold text-gray-800">
                        {{ $vehicle->brand }} - {{ $vehicle->model }}
                    </h3>

                    <p><span class="font-semibold">اللون:</span> {{ $vehicle->color }}</p>
                    <p><span class="font-semibold">رقم اللوحة:</span> {{ $vehicle->plate_number }}</p>
                    <p><span class="font-semibold">عدد المقاعد:</span> {{ $vehicle->seats_count }}</p>
                    <p>
                        <span class="font-semibold">الحالة:</span>
                        @if ($vehicle->is_active)
                            <span class="text-green-600 font-semibold">مفعلة</span>
                        @else
                            <span class="text-red-600 font-semibold">غير مفعلة</span>
                        @endif
                    </p>

                    <div class="pt-4">
                        <a href="{{ route('vehicles.edit', $vehicle) }}"
                           class="rounded-lg bg-yellow-500 px-4 py-2 text-white hover:bg-yellow-600">
                            تعديل
                        </a>

                        <a href="{{ route('vehicles.index') }}"
                           class="ml-2 rounded-lg bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                            رجوع
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
