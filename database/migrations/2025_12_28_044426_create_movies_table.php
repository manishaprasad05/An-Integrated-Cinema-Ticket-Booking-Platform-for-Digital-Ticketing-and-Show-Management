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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('poster');
             $table->decimal('price', 8, 2);
            $table->string('language')->nullable();
            $table->string('genre')->nullable();
            $table->integer('duration')->nullable();
            $table->float('rating')->default(0);
            $table->string('trailer_url')->nullable();
             


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
