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
        Schema::create('sale_document', function (Blueprint $table) {
            $table->id('id_sale_document');
            $table->unsignedBigInteger('id_sales');
            $table->unsignedBigInteger('id_order_sale_document')->nullable();

            // Foreign key constraints
            $table->foreign('id_order_sale_document')->references('id_order_sale_document')->on('order_sale_document')->onDelete('cascade');
            $table->foreign('id_sales')->references('id_sales')->on('sale')->onDelete('cascade');
            //$table->foreign('id_sales')->references('id')->on('sales')->onDelete('cascade');
            //$table->foreign('id_order_sale_document')->references('id_order_sale_document')->on('order_sale_documents')->onDelete('cascade');

            //INHERIT
            $table->integer('sale');
            $table->integer('sale_document');
            $table->integer('order_sale_document');

            // Primary key constraint
            //$table->primary('id_sale_document', 'sale_document_pk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_document');
    }
};
