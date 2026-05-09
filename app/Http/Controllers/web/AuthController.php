<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * حقن الـ repository داخل الكنترولر
     */
    public function __construct(
        protected AuthRepositoryInterface $authRepository
    ) {}

    /**
     * عرض صفحة التسجيل
     */
    public function showRegister(): View
    {
        return view('auth.custom-register');
    }

    /**
     * تنفيذ عملية التسجيل
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        // إنشاء المستخدم
        $user = $this->authRepository->register($request);

        // تسجيل دخوله مباشرة بعد التسجيل
        Auth::login($user);

        // إعادة إنشاء session للحماية
        $request->session()->regenerate();

        // تحويل المستخدم للوحة التحكم
        return redirect()
        ->route('dashboard')
        ->with('success', 'تم إنشاء الحساب بنجاح');
    }

    /**
     * عرض صفحة تسجيل الدخول
     */
    public function showLogin(): View
    {
        return view('auth.custom-login');
    }

    /**
     * تنفيذ تسجيل الدخول
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        // البيانات المطلوبة لتسجيل الدخول
        $credentials = $request->only('email', 'password');

        // التحقق من remember me
        $remember = $request->boolean('remember');

        // محاولة تسجيل الدخول
        if (! $this->authRepository->attemptLogin($credentials, $remember)) {
            return back()->withErrors([
                'email' => 'بيانات الدخول غير صحيحة',
            ])->onlyInput('email');    // لو ف غلط هيرجع لصفحة تسجيل دخول والايميل الي نت كتبتة موجود
        }

        // إعادة إنشاء الـ session للحماية
        $request->session()->regenerate();

        // التحويل للداشبورد
        return redirect()
       ->intended()
        ->with('success', 'تم تسجيل الدخول بنجاح');
    }

    /**
     * تسجيل الخروج من الويب
     */
    public function logout(Request $request): RedirectResponse
    {
        // تنفيذ تسجيل الخروج
        $this->authRepository->logout();

        // إلغاء الجلسة الحالية
        $request->session()->invalidate();

        // إنشاء CSRF token جديد
        $request->session()->regenerateToken();

        return redirect()
        ->route('login')
        ->with('success', 'تم تسجيل الخروج بنجاح');
    }
}
