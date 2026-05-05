<?php

namespace App\Interfaces;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

interface AuthRepositoryInterface
{
    /**
     * تسجيل مستخدم جديد
     */
    public function register(RegisterRequest $request): User;

    /**
     * محاولة تسجيل الدخول
     */
    public function attemptLogin(array $credentials, bool $remember = false): bool;

    /**
     * إنشاء توكن API للمستخدم
     */
    public function createToken(User $user, string $tokenName = 'api-token'): string;

    /**
     * تسجيل خروج الويب
     */
    public function logout(): void;

    /**
     * حذف التوكن الحالي في الـ API
     */
    public function revokeCurrentToken(User $user): void;
}
