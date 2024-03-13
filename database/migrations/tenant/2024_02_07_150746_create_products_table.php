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
        Schema::create('product', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('description', 255);
            $table->string('foreign_name')->nullable();
            $table->string('product_code', 45)->nullable();
            $table->boolean('state')->default(false);
            $table->string('group_code', 45);
            $table->timestamps();
        });

        //DB::statement('ALTER TABLE products OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
