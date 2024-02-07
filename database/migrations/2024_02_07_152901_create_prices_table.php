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
        Schema::create('prices', function (Blueprint $table) {
            $table->id('id_price');
            $table->unsignedBigInteger('idproduct');
            $table->unsignedBigInteger('idcurrency');
            $table->decimal('price');
            $table->unsignedBigInteger('id_list_price')->nullable();

            // Primary key constraint
            //$table->primary('id_price', 'price_pk');

            // Foreign key constraints
            //$table->foreign('idproduct')->references('idproduct')->on('products')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('idcurrency')->references('idcurrency')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('id_list_price')->references('id_list_price')->on('list_prices')->onDelete('set null')->onUpdate('cascade');
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
