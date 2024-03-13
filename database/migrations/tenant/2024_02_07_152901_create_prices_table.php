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
        Schema::create('price', function (Blueprint $table) {
            $table->id('id_price');
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_currency');
            $table->decimal('price');
            $table->unsignedBigInteger('id_list_price')->nullable();
            $table->timestamps();

            // Primary key constraint
            //$table->primary('id_price', 'price_pk');

            // Foreign key constraints
            $table->foreign('id_product')->references('id_product')->on('product')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_currency')->references('id_currency')->on('currency')->onDelete('cascade')->onUpdate('cascade');
            // Si hay una relación uno a uno con list_prices, también agregue la siguiente línea:
            $table->foreign('id_list_price')->references('id_list_price')->on('price_list')->onDelete('cascade')->onUpdate('cascade');
        });

        // Set owner of the table
        //DB::statement('ALTER TABLE prices OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
