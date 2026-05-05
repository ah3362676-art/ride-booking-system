<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * تشغيل المايجريشن وإنشاء جدول المستخدمين
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // اسم المستخدم
            $table->string('name');

            // الإيميل ويجب أن يكون فريد
            $table->string('email')->unique();

            // رقم الهاتف - جعلناه unique لأن كل مستخدم بحساب مستقل
            $table->string('phone')->unique();

            // الدور الخاص بالمستخدم
            // admin = أدمن
            // driver = سائق
            // rider = راكب
            $table->enum('role', ['admin', 'driver', 'rider'])->default('rider');

            // هل الحساب مفعل أم لا
            $table->boolean('is_active')->default(true);

            // تاريخ التحقق من البريد
            $table->timestamp('email_verified_at')->nullable();

            // كلمة المرور
            $table->string('password');

            // تذكرني
            $table->rememberToken();

            $table->timestamps();
        });
    }

    /**
     * حذف الجدول عند الرجوع في المايجريشن
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
