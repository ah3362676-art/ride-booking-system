<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * إنشاء جدول الرحلات
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();

            // السائق صاحب الرحلة
            $table->foreignId('driver_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // المركبة المستخدمة في الرحلة
            $table->foreignId('vehicle_id')
                ->constrained()
                ->cascadeOnDelete();

            // عنوان البداية
            $table->string('start_address');

            // إحداثيات البداية
            $table->decimal('start_lat', 10, 7);   // عشرة ارقام إجمالي بس 7 أرقام بعد العلامة العشرية
            $table->decimal('start_lng', 10, 7);

            // عنوان النهاية
            $table->string('end_address');

            // إحداثيات النهاية
            $table->decimal('end_lat', 10, 7);
            $table->decimal('end_lng', 10, 7);

            // وقت الانطلاق
            $table->dateTime('departure_time');

            // عدد المقاعد المتاحة
            $table->unsignedTinyInteger('available_seats');   //رقم صحيح موجب مينفعش يبقي سالب

            // السعر لكل مقعد
            $table->decimal('price_per_seat', 10, 2);

            // حالة الرحلة
            // scheduled = مجدولة
            // in_progress = بدأت
            // completed = انتهت
            // cancelled = أُلغيت
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled'])
                ->default('scheduled');

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
        Schema::dropIfExists('trips');
    }
};
