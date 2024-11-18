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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();  // Khóa chính của bảng
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Khóa ngoại liên kết với bảng users
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');  // Khóa ngoại liên kết với bảng products
            $table->foreignId('variant_id')->constrained('variants')->onDelete('cascade');  // Khóa ngoại liên kết với bảng variants
            $table->integer('quantity')->default(1);  // Số lượng sản phẩm trong giỏ hàng
            $table->timestamps();  // Created at và updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');  // Xóa bảng carts nếu cần
    }
};
