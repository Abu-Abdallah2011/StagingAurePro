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
        Schema::table('marriage', function (Blueprint $table) {
            $table->unsignedBigInteger('venue_id');
            $table->foreign('venue_id')->references('id')->on('masajid');
            $table->string('status')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->boolean('active')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marriage', function (Blueprint $table) {
            //
        });
    }
};
