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
        Schema::create('driver_sale', function (Blueprint $table) {
            $table->id('id_driver_sale');
            $table->unsignedBigInteger('id_sales');
            $table->unsignedBigInteger('id_driver');
            $table->unsignedBigInteger('id_vehicle');
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('id_sales')->references('id_sales')->on('sale')->onDelete('cascade');
            $table->foreign('id_driver')->references('id_driver')->on('driver')->onDelete('cascade');
            $table->foreign('id_vehicle')->references('id_vehicle')->on('vehicle')->onDelete('cascade');
        });

        // Set owner of the table
        // DB::statement('ALTER TABLE driver_sales OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_sale');
    }
};
