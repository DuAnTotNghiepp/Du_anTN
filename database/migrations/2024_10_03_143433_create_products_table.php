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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Catalogues::class)->constrained()->onDelete('cascade');
            $table->string('name');
            $table->String('slug')->unique();
            $table->String('sku')->unique();
            $table->String('img_thumbnail')->nullable();
            $table->double('price_regular');
            $table->double('price_sale')->nullable();
            $table->String('description')->nullable();
            $table->text('content')->nullable();
            $table->string('material')->nullable()->comment('chat lieu');
            $table->text('user_manual')->nullable()->comment('huong dan sd');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('view')->default(0);
            $table->boolean('is_hot_deal')->default(false);
            $table->boolean('is_good_deal')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_show_home')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
