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
       Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->unsignedBigInteger('order_id'); // ID đơn hàng
            $table->unsignedBigInteger('product_id'); // ID sản phẩm
            $table->string('product_name'); // Tên sản phẩm
            $table->string('size')->nullable(); 
            $table->string('color')->nullable(); 
            $table->decimal('price'); // Giá sản phẩm
            $table->integer('quantity') ;// Thêm trường quantity
            $table->timestamps(); // Thời gian tạo và cập nhật

            // Thiết lập khóa ngoại
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
