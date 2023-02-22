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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();

            $table->integer('userID');
            $table->string('name', 255);
            $table->string('vendor', 255);
            $table->string('url', 255);
            $table->float('price');

            $table->float('weight');
            $table->float('servings');
            $table->integer('expiry');

            $table->float('per');
            $table->float('calories');
            $table->float('carbohydrate');

            $table->float('sugar');
            $table->float('fat');
            $table->float('saturated');

            $table->float('protein');
            $table->float('fibre');
            $table->float('salt');

            $table->float('alcohol');
            $table->boolean('fruit');
            $table->boolean('vegetable');

            $table->boolean('vegan');
            $table->boolean('vegetarian');
            $table->boolean('hiddenRow');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
