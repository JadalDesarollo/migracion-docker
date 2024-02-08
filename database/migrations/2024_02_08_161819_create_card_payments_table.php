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
        Schema::create('card_payments', function (Blueprint $table) {
            $table->id('id_card_payment');
            $table->unsignedBigInteger('id_payment');
            $table->unsignedBigInteger('id_card');
            $table->timestamps();

            // Constraints
            //$table->foreign('id_payment')->references('id')->on('payments')->onDelete('cascade');
            //$table->foreign('id_card')->references('id')->on('cards')->onDelete('cascade');

            // Primary key constraint
            //$table->primary('id_card_payment');

            // If you want to create indexes or unique constraints, you can define them here
            // $table->index('id_payment');
            // $table->index('id_card');
        });

        // Set owner of the table
        // DB::statement('ALTER TABLE card_payments OWNER TO postgres');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_payments');
    }
};
