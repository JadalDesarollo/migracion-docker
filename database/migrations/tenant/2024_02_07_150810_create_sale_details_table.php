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
        Schema::create('sale_detail', function (Blueprint $table) {
            $table->id('id_sale_detail');
            $table->decimal('quantity');
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_sales');
            $table->decimal('product_price');
            $table->jsonb('detail_tax')->nullable();
            //$table->decimal('subtotal');

            // Add foreign key constraints if needed
            $table->foreign('id_product')->references('id_product')->on('product')->onDelete('cascade');
            //$table->foreign('id_sales')->references('id_sales')->on('sales')->onDelete('cascade');

            // Primary key constraint
            //$table->primary('id_sale_detail', 'SALE_DETAIL_pk');
            $table->timestamps();
        });

        // Set owner of the table
        //DB::statement('ALTER TABLE sale_details OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
