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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Store user's name
            $table->string('rec_address')->nullable(); // Recipient's address
            $table->string('phone')->nullable(); // User's phone number
            $table->string('status')->default('in progress'); // Default order status
            $table->unsignedBigInteger('user_id'); // User ID (foreign key)
            $table->unsignedBigInteger('product_id'); // Product ID (foreign key)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
