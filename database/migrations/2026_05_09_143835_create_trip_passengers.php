<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trip_passengers', function (Blueprint $table) {
            $table->id();

            // الرحلة
            $table->foreignId('trip_id')
                ->constrained()
                ->cascadeOnDelete();

            // الراكب
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // الطلب
            $table->foreignId('trip_request_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // عدد المقاعد
            $table->unsignedInteger('seats_booked');

            // السعر
            $table->decimal('price_per_seat', 8, 2);
            $table->decimal('total_price', 10, 2);

            // الحالة
            $table->enum('status', [
                'pending',
                'confirmed',
                'cancelled'
            ])->default('pending');

            $table->timestamps();

            // منع تكرار نفس الراكب في نفس الرحلة
            $table->unique(['trip_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trip_passengers');
    }
};
