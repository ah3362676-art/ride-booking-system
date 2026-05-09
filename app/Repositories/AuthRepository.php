<?php

namespace App\Repositories;

use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * إنشاء مستخدم جديد من بيانات التسجيل
     */
    public function register(RegisterRequest $request): User
    {
        $data= $request->validated();
        return User::create([
            // اسم المستخدم
            'name' =>$data['name'],

            // البريد
            'email' => $data['email'],

            // الهاتف
            'phone' => $data['phone'],

            // الدور
            'role' => $data['role'],

            // الحساب مفعل افتراضيًا
            'is_active' => true,

            // كلمة المرور
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * محاولة تسجيل الدخول بالبيانات
     */
    public function attemptLogin(array $credentials, bool $remember = false): bool
    {
        return Auth::attempt($credentials, $remember);
            // Auth::attempt()
            // بتحاول تتحقق من صحة بيانات المستخدم (زي email + password)
    }

    /**
     * إنشاء API token
     */
    public function createToken(User $user, string $tokenName = 'api-token'): string
    {
        return $user->createToken($tokenName)->plainTextToken;
    }

    /**
     * تسجيل خروج المستخدم من الويب
     */
    public function logout(): void
    {
        Auth::logout();
        // بيعمل تسجيل خروج  للمستخدم الحالي.
    }

    /**
     * حذف التوكن الحالي للمستخدم
     */
    public function revokeCurrentToken(User $user): void
    {
        $user->currentAccessToken()?->delete();
    }
}
