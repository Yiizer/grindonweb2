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
        Schema::table('orders', function (Blueprint $table) {
            // Check if the 'payment_method' column does not exist before adding it
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->nullable();  // Add the payment_method column
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Check if the 'payment_method' column exists before dropping it
            if (Schema::hasColumn('orders', 'payment_method')) {
                $table->dropColumn('payment_method');
            }
        });
    }
};
