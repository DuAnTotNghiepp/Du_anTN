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
        Schema::table('product__variants', function (Blueprint $table) {
            // Thêm khóa ngoại cho product_id và variants_id
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('variants_id')->references('id')->on('variants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('product__variants', function (Blueprint $table) {
            // Xóa khóa ngoại nếu cần
            $table->dropForeign(['product_id']);
            $table->dropForeign(['variants_id']);
        });
    }
};
