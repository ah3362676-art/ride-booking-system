<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::create('messages', function (Blueprint $table) {

        $table->id();

        // الرحلة المرتبط بها الشات
        $table->foreignId('trip_id')
            ->constrained()
            ->cascadeOnDelete();

        // المرسل
        $table->foreignId('sender_id')
            ->constrained('users')
            ->cascadeOnDelete();

        // الرسالة
        $table->text('message');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
