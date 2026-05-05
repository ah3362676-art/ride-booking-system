<x-guest-layout>
    <div class="mb-6">
        {{-- عنوان الصفحة --}}
        <h1 class="text-2xl font-bold text-gray-800">تسجيل الدخول</h1>

        {{-- وصف بسيط --}}
        <p class="mt-2 text-sm text-gray-500">
            سجّل دخولك للوصول إلى لوحة التحكم والرحلات الخاصة بك.
        </p>
    </div>

    {{-- حالة الجلسة --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
        @csrf

        <div>
            {{-- البريد --}}
            <x-input-label for="email" value="البريد الإلكتروني" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            {{-- كلمة المرور --}}
            <x-input-label for="password" value="كلمة المرور" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="text-sm text-gray-600">تذكرني</span>
            </label>

            <x-primary-button>
                دخول
            </x-primary-button>
        </div>

        <div class="text-sm">
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800">
                ليس لديك حساب؟ أنشئ حسابًا
            </a>
        </div>
    </form>
    </x-guest-layout>
