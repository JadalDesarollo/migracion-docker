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
        Schema::create('proforma', function (Blueprint $table) {
            $table->id('id_proforma');
            $table->date('broadcast_date');
            $table->unsignedBigInteger('id_currency');
            $table->unsignedBigInteger('id_local');
            $table->unsignedBigInteger('id_transaction');
            $table->unsignedBigInteger('id_user_view')->nullable();
            $table->unsignedBigInteger('id_employee')->nullable();
            $table->timestamps();
            //$table->softDeletes();

            // Define foreign key constraints
            $table->foreign('id_currency')->references('id_currency')->on('currency')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_local')->references('id_local')->on('local')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_transaction')->references('id_transaction')->on('transaction')->onDelete('cascade')->onUpdate('cascade');
        });
        // Ejecuta SQL puro para agregar herencia
        DB::statement('ALTER TABLE proforma INHERIT transaction');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proformas');
    }
};
