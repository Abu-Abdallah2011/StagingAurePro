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
        Schema::table('masajid', function (Blueprint $table) {
            $table->unsignedBigInteger('imam_id');
            $table->unsignedBigInteger('muazzin_id');
            $table->unsignedBigInteger('chairman_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('masajid', function (Blueprint $table) {
            //
        });
    }
};
