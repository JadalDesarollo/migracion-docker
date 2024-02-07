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
        Schema::create('sale_facturas', function (Blueprint $table) {
            $table->smallInteger('factura_number');
            $table->date('broadcast_date');
            $table->date('expiration_date');
            $table->string('id_emisor', 45);
            $table->string('id_receptor', 45);
            $table->string('payment_conditions', 250);
            $table->string('observations', 255);

            // Add missing columns for inheritance
            $table->integer('sales');
            $table->integer('sale_document');
            $table->integer('order_sale_document');

            // Add inherited columns
            $table->unsignedBigInteger('id_sale_document');
            $table->unsignedBigInteger('id_sales');
            $table->unsignedBigInteger('id_order_sale_document');

            // Add foreign key constraints if necessary
            // $table->foreign('id_sale_document')->references('id')->on('sale_documents')->onDelete('cascade');
            // $table->foreign('id_sales')->references('id')->on('sales')->onDelete('cascade');
            // $table->foreign('id_order_sale_document')->references('id_order_sale_document')->on('order_sale_documents')->onDelete('cascade');

            // Set primary key
            $table->primary('factura_number');
            $table->timestamps();
        });
        // Ejecuta SQL puro para agregar herencia
        DB::statement('ALTER TABLE sale_facturas INHERIT sale_documents;');
        // Set owner of the table
       //DB::statement('ALTER TABLE sale_facturas OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_facturas');
    }
};
