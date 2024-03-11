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
        Schema::create('client_sales', function (Blueprint $table) {
            $table->id('id_client_sale');
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_sales');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_sales')->references('id_sales')->on('sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_sales');
    }
};
