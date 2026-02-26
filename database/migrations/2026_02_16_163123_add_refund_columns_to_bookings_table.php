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
        Schema::table('bookings', function (Blueprint $table) {

            $table->string('refund_status')->nullable()->after('status');
            $table->unsignedInteger('refund_amount')->nullable()->after('refund_status');
            $table->dateTime('refund_date')->nullable()->change(); 
            // change() only if you want datetime instead of date

        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            $table->dropColumn([
                'refund_status',
                'refund_amount',
            ]);

        });
    }
};
