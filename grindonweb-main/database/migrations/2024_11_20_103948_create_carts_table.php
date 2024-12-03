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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            // User and product references
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');

            // New fields for size, color, and quantity
            $table->string('size'); // Example: Small, Medium, Large
            $table->string('logo'); // Example: Black, White
            $table->integer('quantity')->default(1); // Quantity of the product in the cart
            $table->decimal('price', 8, 2); // Price of the product for this cart entry

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');

            // Timestamps for cart entries
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
