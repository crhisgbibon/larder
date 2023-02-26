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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id()->unique();

            $table->integer('userID');
            $table->string('ingredients', 5000);
            $table->string('instructions', 5000);

            $table->string('name', 250);
            $table->float('servings');
            $table->float('per');
            $table->integer('expiry');
            $table->boolean('hiddenRow');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
