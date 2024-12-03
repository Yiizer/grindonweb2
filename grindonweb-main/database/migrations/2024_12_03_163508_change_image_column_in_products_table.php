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
        Schema::table('products', function (Blueprint $table) {
            $table->text('image')->change(); // Change the image column to TEXT
        });
    }
    
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image', 255)->change(); // Revert back to VARCHAR(255) if rolling back
        });
    }
    
};
