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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();;
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('color_variant_id')->nullable();
            $table->unsignedBigInteger('size_variant_id')->nullable();
            $table->integer('stock')->default(0)->nullable();
            $table->foreign('color_variant_id')->references('id')->on('variants')->onDelete('cascade');
            $table->foreign('size_variant_id')->references('id')->on('variants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
