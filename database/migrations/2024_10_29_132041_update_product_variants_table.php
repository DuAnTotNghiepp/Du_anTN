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
        // Đầu tiên, hãy chắc chắn rằng bảng hiện tại đã tồn tại
        Schema::table('product__variants', function (Blueprint $table) {
            // Đổi tên cột variants_id thành variant_id
            $table->renameColumn('variants_id', 'variant_id');

            // Thêm khóa ngoại cho các cột
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::table('product__variants', function (Blueprint $table) {
            // Xóa khóa ngoại trước khi xóa cột
            $table->dropForeign(['product_id']);
            $table->dropForeign(['variant_id']);

            // Đổi tên lại cột variant_id về variants_id
            $table->renameColumn('variant_id', 'variants_id');
        });
    }
};
