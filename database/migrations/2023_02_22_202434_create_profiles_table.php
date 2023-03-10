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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id()->unique();

            $table->integer('userID')->unique();
            $table->boolean('gender');
            $table->float('height');

            $table->integer('dateofbirth');
            $table->float('weightTarget');
            $table->float('caloryBurn');

            $table->float('caloryGoal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
