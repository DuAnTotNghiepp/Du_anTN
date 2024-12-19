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
        Schema::table('products', function (Blueprint $table) {
            // Thêm khóa ngoại liên kết với bảng 'material'
            $table->foreignIdFor(\App\Models\Material::class)->nullable()->constrained()->onDelete('cascade');

            // Xóa cột 'material' nếu nó tồn tại trong bảng 'products'
            $table->dropColumn('material'); // Đảm bảo tên cột là chính xác
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Lật lại các thay đổi trong trường hợp rollback migration

            // Thêm lại cột 'material'
            $table->string('material')->nullable()->comment('Chất liệu');

            // Xóa khóa ngoại nếu cần
            $table->dropForeign(['material_id']); // Tên khóa ngoại sẽ là <table>_<column>_foreign
            $table->dropColumn('material_id'); // Nếu bạn đã thêm khóa ngoại vào cột 'material_id'
        });
    }
};

