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
            $table->id();
            $table->unsignedBigInteger('cart_id')->nullable(); // ID của giỏ hàng mà mục này thuộc về
            $table->unsignedBigInteger('product_variant_id')->nullable(); // ID của biến thể sản phẩm
            $table->unsignedInteger('quantity')->default(0); // Số lượng sản phẩm trong giỏ hàng, mặc định là 0
            $table->string('product_name'); // Tên sản phẩm
            $table->string('product_sku'); // SKU (Stock Keeping Unit) của sản phẩm
            $table->string('product_img_thumbnail')->nullable(); // Hình ảnh thu nhỏ của sản phẩm, có thể là NULL
            $table->double('product_price_regular'); // Giá thông thường của sản phẩm
            $table->double('product_price_sale')->nullable(); // Giá giảm của sản phẩm, có thể là NULL
            $table->string('size'); // Tên kích thước của biến thể sản phẩm
            $table->string('color'); // Tên màu sắc của biến thể sản phẩm
            $table->unsignedBigInteger('user_id'); // ID người dùng
            $table->unsignedBigInteger('product_id'); // ID sản phẩm
            $table->timestamps(); // Thời gian tạo và cập nhật bản ghi
            $table->unsignedBigInteger('order_id')->nullable(); // Cột order_id không cần `after()`

            // Thiết lập khóa ngoại

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
