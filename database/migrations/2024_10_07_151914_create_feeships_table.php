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
        Schema::create('feeships', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('city_code');
            $table->bigInteger('province_code');
            $table->bigInteger('village_code');
            $table->string('feeship');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeships');
    }
};
