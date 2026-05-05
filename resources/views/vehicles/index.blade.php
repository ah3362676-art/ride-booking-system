<x-app-layout>
    <x-slot name="header">
        {{-- عنوان الصفحة --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            مركباتي
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

            {{-- زر إضافة مركبة --}}
            <div class="mb-4">
                <a href="{{ route('vehicles.create') }}"
                   class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    إضافة مركبة جديدة
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse ($vehicles as $vehicle)
                        <div class="mb-4 rounded-lg border p-4">
                            <h3 class="text-lg font-bold text-gray-800">
                                {{ $vehicle->brand }} - {{ $vehicle->model }}
                            </h3>

                            <div class="mt-2 space-y-1 text-sm text-gray-600">
                                <p>اللون: {{ $vehicle->color }}</p>
                                <p>رقم اللوحة: {{ $vehicle->plate_number }}</p>
                                <p>عدد المقاعد: {{ $vehicle->seats_count }}</p>
                                <p>
                                    الحالة:
                                    @if ($vehicle->is_active)
                                        <span class="font-semibold text-green-600">مفعلة</span>
                                    @else
                                        <span class="font-semibold text-red-600">غير مفعلة</span>
                                    @endif
                                </p>
                            </div>

                            <div class="mt-4 flex items-center gap-3">
                                <a href="{{ route('vehicles.show', $vehicle) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                    عرض
                                </a>

                                <a href="{{ route('vehicles.edit', $vehicle) }}"
                                   class="text-yellow-600 hover:text-yellow-800">
                                    تعديل
                                </a>

                                <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST"
                                      onsubmit="return confirm('هل أنت متأكد من حذف المركبة؟')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">لا توجد مركبات حتى الآن.</p>
                    @endforelse

                    <div class="mt-6">
                        {{ $vehicles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
