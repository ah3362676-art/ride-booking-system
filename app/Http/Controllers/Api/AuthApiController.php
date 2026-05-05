<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    /**
     * حقن الـ repository
     */
    public function __construct(
        protected AuthRepositoryInterface $authRepository
    ) {}

    /**
     * تسجيل مستخدم جديد عبر الـ API
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        // إنشاء المستخدم
        $user = $this->authRepository->register($request);

        // إنشاء توكن
        $token = $this->authRepository->createToken($user);

        return response()->json([
            'message' => 'تم إنشاء الحساب بنجاح',
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    /**
     * تسجيل الدخول عبر الـ API
     */
    public function login(LoginRequest $request): JsonResponse
    {
        // محاولة تسجيل الدخول
        if (! $this->authRepository->attemptLogin($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'بيانات الدخول غير صحيحة',
            ], 422);
        }

        // الحصول على المستخدم الحالي
        $user = Auth::user();

        // إنشاء توكن جديد
        $token = $this->authRepository->createToken($user);

        return response()->json([
            'message' => 'تم تسجيل الدخول بنجاح',
            'token' => $token,
            'user' => $user,
        ]);
    }

    /**
     * جلب بيانات المستخدم الحالي
     */
    public function me(): JsonResponse
    {
        return response()->json([
            'user' => auth()->user(),
        ]);
    }

    /**
     * تسجيل الخروج من الـ API
     */
    public function logout(): JsonResponse
    {
        $user = auth()->user();

        $this->authRepository->revokeCurrentToken($user);

        return response()->json([
            'message' => 'تم تسجيل الخروج بنجاح',
        ]);
    }
}
