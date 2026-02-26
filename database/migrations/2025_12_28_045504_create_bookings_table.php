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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('movie_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('screen');
            $table->string('show_time');

            // Seats like: A1,A2,A3
            $table->string('seats');

            // Total price
            $table->unsignedInteger('total');

            // pending | paid | cancelled
            $table->string('status')->default('pending');

            $table->string('payment_method')->nullable(); // removed after()
            $table->integer('rating')->nullable();
            $table->text('feedback')->nullable();
            $table->date('refund_date')->nullable();
            
            


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
