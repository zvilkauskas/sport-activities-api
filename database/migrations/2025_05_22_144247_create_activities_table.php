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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('activity_type');
            $table->string('session_type');
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->decimal('price', 8, 2);
            $table->decimal('rating', 2, 1);
            $table->dateTime('start_date');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 10, 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
