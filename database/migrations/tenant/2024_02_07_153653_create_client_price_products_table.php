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
        Schema::create('client_price_product', function (Blueprint $table) {
            $table->id('id_client_price_product');
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_client');
            $table->decimal('price');
            $table->unsignedBigInteger('id_currency');

            $table->foreign('id_product')->references('id_product')->on('product')->onDelete('set null')->onUpdate('cascade');
            // Add foreign key constraint for id_client referencing clients table
            $table->foreign('id_client')->references('id_client')->on('client')->onDelete('cascade')->onUpdate('cascade');
            // Add foreign key constraint for idcurrency referencing currencies table
            $table->foreign('id_currency')->references('id_currency')->on('currency')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        //DB::statement('ALTER TABLE client_price_products OWNER TO postgres');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_price_product');
    }
};
