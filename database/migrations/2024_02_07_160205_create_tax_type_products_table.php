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
        Schema::create('tax_type_products', function (Blueprint $table) {
            $table->id('id_tax_type_product');
            $table->unsignedBigInteger('id_type_tax');
            $table->unsignedBigInteger('idproduct');
            $table->timestamps();

            //$table->foreign('id_type_tax')->references('id_type_tax')->on('type_tax')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('idproduct')->references('idproduct')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });

        //DB::statement('ALTER TABLE tax_type_products OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_type_products');
    }
};
