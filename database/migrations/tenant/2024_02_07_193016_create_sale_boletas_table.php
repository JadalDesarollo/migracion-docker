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
        Schema::create('sale_boleta', function (Blueprint $table) {
            $table->id();
            $table->string('boleta_number', 45);
            $table->date('broadcast_date');
            $table->string('description', 255);

            // Add missing columns for inheritance
            $table->integer('sale');
            $table->integer('sale_document');
            $table->integer('order_sale_document');

            // Add inherited columns
            $table->unsignedBigInteger('id_sale_document');
            $table->unsignedBigInteger('id_sales');
            $table->unsignedBigInteger('id_order_sale_document');

            $table->timestamps();
        });

        // Agrega la herencia
        DB::statement('ALTER TABLE sale_boleta INHERIT sale_document');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_boletas');
    }
};
