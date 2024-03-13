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
        Schema::create('payment', function (Blueprint $table) {
            $table->id('id_payment');
            $table->smallInteger('id_payment_method')->nullable();
            $table->unsignedBigInteger('id_sales')->nullable();
            $table->unsignedBigInteger('id_currency')->nullable();

            // Constraints
            $table->foreign('id_sales')->references('id_sales')->on('sale')->onDelete('cascade');
            $table->foreign('id_payment_method')->references('id_payment_method')->on('payment_method')->onDelete('cascade');
            $table->foreign('id_currency')->references('id_currency')->on('currency')->onDelete('cascade');

            // Primary key constraint (alternatively you can use id() or increments() instead of id_payment)
            // $table->primary('id_payment');

            // If you want to create indexes or unique constraints, you can define them here
            // $table->index('id_payment_method');
            // $table->unique('id_payment_method');
            $table->timestamps();
        });

        // Set owner of the table
        // DB::statement('ALTER TABLE payment OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
