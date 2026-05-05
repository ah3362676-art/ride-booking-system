<x-app-layout>
    {{-- عنوان الصفحة --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            لوحة التحكم
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-3">
                    {{-- ترحيب بالمستخدم --}}
                    <h3 class="text-lg font-bold">
                        أهلاً {{ auth()->user()->name }}
                    </h3>

                    {{-- عرض معلومات أساسية عن المستخدم --}}
                    <p>البريد الإلكتروني: {{ auth()->user()->email }}</p>
                    <p>رقم الهاتف: {{ auth()->user()->phone }}</p>
                    <p>نوع الحساب: {{ auth()->user()->role->value }}</p>

                    {{-- لاحقًا سنضع هنا اختصارات حسب الدور --}}
                    <div class="mt-4">
                        <p class="text-sm text-gray-500">
                            لاحقًا سنعرض هنا الرحلات والمركبات وطلبات الانضمام حسب نوع المستخدم.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
