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
        Schema::create('person_address', function (Blueprint $table) {
            $table->id('id_person_address');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('address_id');

            // Primary key constraint
            //$table->primary('id_person_address', 'person_address_pk');

            // Foreign key constraints
            $table->foreign('person_id')->references('id_person')->on('person')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('address_id')->references('id_address')->on('address')->onDelete('cascade');
        });

        // Set owner of the table
        //DB::statement('ALTER TABLE person_addresses OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_address');
    }
};
