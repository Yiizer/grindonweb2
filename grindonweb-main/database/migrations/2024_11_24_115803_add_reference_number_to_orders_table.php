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
            // Check if the 'reference_number' column does not exist before adding it
            if (!Schema::hasColumn('orders', 'reference_number')) {
                $table->string('reference_number')->nullable(); // Allow null if not always required
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Check if the 'reference_number' column exists before dropping it
            if (Schema::hasColumn('orders', 'reference_number')) {
                $table->dropColumn('reference_number');
            }
        });
    }
};
