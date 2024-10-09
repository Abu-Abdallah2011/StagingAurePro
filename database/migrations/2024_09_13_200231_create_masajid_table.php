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
        Schema::create('masajid', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('cac_reg')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('acct_no')->nullable();
            $table->string('acct_name')->nullable();
            $table->string('bank')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masajid');
    }
};
