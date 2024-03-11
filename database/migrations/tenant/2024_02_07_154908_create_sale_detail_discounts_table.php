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
        Schema::create('sale_detail_discounts', function (Blueprint $table) {
            $table->id('id_sale_detail_discount');
            $table->unsignedSmallInteger('id_sale_detail');
            $table->unsignedBigInteger('id_discount');

            // Add foreign key constraint for id_sale_detail referencing sale_details table
            $table->foreign('id_sale_detail')->references('id_sale_detail')->on('sale_details')->onDelete('cascade')->onUpdate('cascade');
            // Add foreign key constraint for iddiscount referencing discounts table
            $table->foreign('id_discount')->references('id_discount')->on('discounts')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        //DB::statement('ALTER TABLE sale_detail_discounts OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_detail_discounts');
    }
};
