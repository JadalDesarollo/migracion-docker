<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order');
            $table->unsignedBigInteger('id_transaction');
            $table->unsignedBigInteger('id_user_view')->nullable();
            $table->unsignedBigInteger('id_employee');
            $table->unsignedBigInteger('id_proforma');

           // Foreign key constraint for id_proforma
           $table->foreign('id_proforma')->references('id_proforma')->on('proformas')->onDelete('cascade');

           // Unique constraint for id_proforma
           #$table->unique('id_proforma', 'order_uq');

           // Foreign key constraint for id_order_sale_document
           //$table->foreign('id_order')->references('id_order_sale_document')->on('order_sale_documents')->onDelete('cascade')->onUpdate('cascade');

           // Foreign key constraint for id_transaction
           $table->foreign('id_transaction')->references('id_transaction')->on('transactions')->onDelete('cascade')->onUpdate('cascade');

           // Primary key constraint
           #$table->primary('id_order', 'order_pk');
           $table->timestamps();
        });
        // Ejecuta SQL puro para agregar herencia
        DB::statement('ALTER TABLE orders INHERIT transactions;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
