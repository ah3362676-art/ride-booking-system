{{-- استخدام لياوت التطبيق الأساسية للزوار --}}
<x-guest-layout>
    <div class="mb-6">
        {{-- عنوان الصفحة --}}
        <h1 class="text-2xl font-bold text-gray-800">إنشاء حساب جديد</h1>

        {{-- وصف بسيط --}}
        <p class="mt-2 text-sm text-gray-500">
            أنشئ حسابك كبداية لاستخدام تطبيق مشاركة الرحلات.
        </p>
    </div>

    {{-- عرض الأخطاء العامة --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
        @csrf

        <div>
            {{-- الاسم --}}
            <x-input-label for="name" value="الاسم" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            {{-- البريد --}}
            <x-input-label for="email" value="البريد الإلكتروني" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            {{-- الهاتف --}}
            <x-input-label for="phone" value="رقم الهاتف" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                :value="old('phone')" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div>
            {{-- الدور --}}
            <x-input-label for="role" value="نوع الحساب" />
            <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="rider" @selected(old('role') === 'rider')>راكب</option>
                <option value="driver" @selected(old('role') === 'driver')>سائق</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            {{-- كلمة المرور --}}
            <x-input-label for="password" value="كلمة المرور" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            {{-- تأكيد كلمة المرور --}}
            <x-input-label for="password_confirmation" value="تأكيد كلمة المرور" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
        </div>

        <div class="flex items-center justify-between">
            {{-- رابط تسجيل الدخول --}}
            <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                عندك حساب بالفعل؟
            </a>

            {{-- زر التسجيل --}}
            <x-primary-button>
                إنشاء الحساب
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
