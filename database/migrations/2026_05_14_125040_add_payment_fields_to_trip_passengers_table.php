<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trip_passengers', function (Blueprint $table) {

            // حالة الدفع
            $table->string('payment_status')
                ->default('pending');

            // رقم العملية من Paymob
            $table->string('transaction_id')
                ->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('trip_passengers', function (Blueprint $table) {

            $table->dropColumn([
                'payment_status',
                'transaction_id',
            ]);

        });
    }
};
