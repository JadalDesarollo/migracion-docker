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
        Schema::create('sale_order', function (Blueprint $table) {
            $table->smallInteger('id_sale_order');
            $table->string('observations',255);

            // Add missing columns for inheritance
            $table->unsignedBigInteger('id_sale_document');
            $table->timestamp('date')->nullable();
            $table->string('document_number')->nullable();
            $table->date('broadcast_date')->nullable();
            $table->string('situation', 255)->nullable();
            $table->unsignedBigInteger('id_sales');

            //add
            $table->unsignedBigInteger('id_order_sale_document')->nullable();
            $table->integer('sale');
            $table->integer('sale_document');
            $table->integer('order_sale_document');

            $table->timestamps();
        });
        // Ejecuta SQL puro para agregar herencia
        DB::statement('ALTER TABLE sale_order INHERIT sale_document;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_order');
    }
};
