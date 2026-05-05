<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * إنشاء جدول طلبات الرحلات
     */
    public function up(): void
    {
        Schema::create('trip_requests', function (Blueprint $table) {
            $table->id();

            // الراكب صاحب الطلب
            $table->foreignId('rider_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // عنوان البداية
            $table->string('start_address');

            // إحداثيات البداية
            $table->decimal('start_lat', 10, 7);
            $table->decimal('start_lng', 10, 7);

            // عنوان النهاية
            $table->string('end_address');

            // إحداثيات النهاية
            $table->decimal('end_lat', 10, 7);
            $table->decimal('end_lng', 10, 7);

            // عدد المقاعد المطلوبة
            $table->unsignedTinyInteger('requested_seats')->default(1);

            // حالة الطلب
            // pending = في الانتظار
            // matched = تم العثور على رحلة مناسبة
            // accepted = تم قبول الطلب
            // rejected = تم رفض الطلب
            // cancelled = تم إلغاء الطلب
            $table->enum('status', ['pending', 'matched', 'accepted', 'rejected', 'cancelled'])
                ->default('pending');

            // الرحلة المطابقة إن وجدت
            $table->foreignId('matched_trip_id')
                ->nullable()
                ->constrained('trips')
                ->nullOnDelete();

            // ملاحظات إضافية
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * حذف الجدول عند التراجع
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_requests');
    }
};
