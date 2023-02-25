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
        Schema::create('nutrient_goals', function (Blueprint $table) {
            $table->id()->unique();

            $table->integer('userID')->unique();
            $table->float('carbohydrate');
            $table->float('sugar');

            $table->float('fat');
            $table->float('saturated');
            $table->float('protein');

            $table->float('fibre');
            $table->float('salt');
            $table->float('alcohol');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrient_goals');
    }
};
