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
            $table->string('pos_id', 45);
            $table->date('date');
            $table->smallInteger('id_sales_reference')->nullable();
            $table->string('state');
            $table->unsignedBigInteger('id_transaction');
            $table->unsignedBigInteger('id_user_view');
            $table->unsignedBigInteger('id_employee');

            // Primary key constraint
            //$table->primary('id_sales', 'SALES_pk');

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
