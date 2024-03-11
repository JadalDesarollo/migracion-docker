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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id('id_driver');
            $table->string('license', 45);
            $table->unsignedBigInteger('id_person');
            $table->string('first_name', 80);
            $table->string('last_name', 80);
            $table->string('address', 45);
            $table->string('document_number', 45);
            $table->string('telphone_number', 45);
            $table->string('email', 45);
            $table->boolean('state')->nullable();
            $table->date('date_of_birth');
            $table->date('creation_date');
            $table->unsignedBigInteger('id_document_type');

            // Foreign key constraint
            //$table->foreign('id_person')->references('id')->on('persons')->onDelete('cascade');

            // Primary key constraint
            //$table->primary('id_driver', 'DRIVER_pk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
