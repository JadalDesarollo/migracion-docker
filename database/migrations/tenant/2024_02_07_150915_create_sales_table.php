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
        Schema::create('sales', function (Blueprint $table) {
            $table->id('id_sales');
            $table->string('pos_id', 45); //no está
            $table->string('state');

            $table->decimal('total_amount', 12, 2)->default(0);
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('total_tax', 12, 2)->default(0);
            $table->decimal('total_discount', 12, 2);

            $table->unsignedBigInteger('id_transaction');
            $table->date('date');
            $table->string('description');
            $table->unsignedBigInteger('id_sale_detail');
            $table->unsignedBigInteger('id_user_view');
            $table->unsignedBigInteger('id_employee');
            $table->unsignedBigInteger('id_local');
            $table->smallInteger('id_document_code')->nullable();

            // Primary key constraint
            //$table->primary('id_sales', 'SALES_pk');
            $table->foreign('id_sale_detail')->references('id_sale_detail')->on('sale_details')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user_view')->references('id_user_view')->on('user_views')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_employee')->references('id_employee')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_local')->references('id_local')->on('locals')->onDelete('cascade')->onUpdate('cascade');

            // Inheritance from transaction table
            $table->foreign('id_transaction')->references('id_transaction')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        // Ejecuta SQL puro para agregar herencia
        DB::statement('ALTER TABLE sales INHERIT transactions;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
