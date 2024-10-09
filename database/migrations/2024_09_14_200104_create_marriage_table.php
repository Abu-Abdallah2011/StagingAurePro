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
        Schema::create('marriage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('husband_id')->nullable();
            $table->unsignedBigInteger('wife_id')->nullable();
            $table->string('date');
            $table->string('time');
            $table->string('venue');
            $table->string('dowry');
            $table->string('dowry_status');
            $table->string('husband_test')->nullable();
            $table->string('wife_test')->nullable();
            $table->unsignedBigInteger('waliyy_id');
            $table->unsignedBigInteger('wakil_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marriage');
    }
};
