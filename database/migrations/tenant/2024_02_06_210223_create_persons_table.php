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
        Schema::create('person', function (Blueprint $table) {
            $table->id('id_person');
            $table->string('first_name', 80);
            $table->string('last_name', 80);
            $table->string('address', 45);
            $table->string('document_number', 45);
            $table->string('telphone_number', 45);
            $table->string('email', 45);
            $table->boolean('state');
            $table->date('date_of_birth');
            $table->date('creation_date');
            $table->unsignedBigInteger('id_document_type');
            //$table->foreign('id_document_type')->references('id')->on('document_types')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person');
    }
};
