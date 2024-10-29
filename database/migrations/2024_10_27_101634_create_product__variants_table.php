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
        Schema::create('product__variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Sửa kiểu dữ liệu ở đây
            $table->unsignedBigInteger('variants_id'); // Sửa kiểu dữ liệu ở đây
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product__variants');
    }
};
