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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Mã voucher (duy nhất)
            $table->enum('type', ['fixed', 'percent'])->default('percent'); // Loại voucher: fixed (giảm giá cố định) hoặc percent (giảm theo phần trăm)
            $table->decimal('value', 10, 2); // Giá trị của voucher
            $table->decimal('minimum_order_value', 10, 2)->nullable(); // Giá trị đơn hàng tối thiểu để áp dụng voucher
            $table->integer('usage_limit')->nullable(); // Giới hạn số lần sử dụng
            $table->integer('used_count')->default(0); // Số lần voucher đã được sử dụng
            $table->dateTime('start_date'); // Ngày bắt đầu hiệu lực
            $table->dateTime('end_date'); // Ngày kết thúc hiệu lực
            $table->boolean('is_visible')->default(0); // 0: Không hiển thị, 1:
            $table->enum('status', ['active', 'expired', 'disabled'])->default('active'); // Trạng thái voucher
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
