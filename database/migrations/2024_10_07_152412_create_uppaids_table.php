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
        Schema::create('uppaids', function (Blueprint $table) {
            $table->string("order_code")->primary();
            $table->string("name");
            $table->string("email");
            $table->string("phone");
            $table->string("note")->nullable();
            $table->integer("method");
            $table->string("coupon_code");
            $table->string("feeship_id");
            $table->string("address");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uppaids');
    }
};
