<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('blog', function (Blueprint $table) {
            $table->string('image')->nullable(); // Thêm cột 'image', có thể là null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('blog', function (Blueprint $table) {
            $table->dropColumn('image'); // Xóa cột 'image' nếu rollback
        });

    }
};
