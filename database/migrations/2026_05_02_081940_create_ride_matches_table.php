<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * إنشاء جدول المطابقات بين طلبات الرحلات والرحلات المتاحة
     */
    public function up(): void
    {
        Schema::create('ride_matches', function (Blueprint $table) {
            $table->id();

            // طلب الرحلة الذي نبحث له عن مطابقة
            $table->foreignId('trip_request_id')
                ->constrained('trip_requests')
                ->cascadeOnDelete();

            // الرحلة المقترحة
            $table->foreignId('trip_id')
                ->constrained('trips')
                ->cascadeOnDelete();

            // درجة التطابق
            $table->decimal('match_score', 5, 2)->default(0);

            // سبب أو ملاحظات المطابقة
            $table->text('match_reason')->nullable();

            // حالة المطابقة
            // suggested = مقترحة
            // accepted = تم قبولها
            // rejected = تم رفضها
            $table->enum('status', ['suggested', 'accepted', 'rejected'])
                ->default('suggested');

            $table->timestamps();

            // منع تكرار نفس المطابقة لنفس الطلب مع نفس الرحلة
            $table->unique(['trip_request_id', 'trip_id']);
        });
    }

    /**
     * حذف الجدول عند التراجع
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_matches');
    }
};
