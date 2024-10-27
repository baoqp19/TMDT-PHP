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
        Schema::table('brands', function (Blueprint $table) {
            // $table->string('description', 255)->change(); // nếu muốn độ dài là 255 ký tự
            // // Hoặc sử dụng:
            $table->text('description')->change(); // nếu cần nhiều hơn 255 ký tự
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
