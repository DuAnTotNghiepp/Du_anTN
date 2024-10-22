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
        Schema::table('binh_luans', function (Blueprint $table) {
            $table->integer('rating')->nullable(); 
        });
    }
    
    public function down()
    {
        Schema::table('binh_luans', function (Blueprint $table) {
            $table->dropColumn('rating'); 
        });
    }
};
