<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trip_passengers', function (Blueprint $table) {
            $table->string('paymob_order_id')->nullable()->after('payment_status');
        });
    }

    public function down(): void
    {
        Schema::table('trip_passengers', function (Blueprint $table) {
            $table->dropColumn('paymob_order_id');
        });
    }
};
