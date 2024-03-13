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
        Schema::create('discount', function (Blueprint $table) {
            $table->id('id_discount');
            $table->string('percentage', 45);
            $table->string('article_code')->nullable();

            // Primary key constraint
            //$table->primary('iddiscount', 'DISCOUNT_pk');
        });

        // Set owner of the table
        //DB::statement('ALTER TABLE discounts OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount');
    }
};
