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
        Schema::create('document_type', function (Blueprint $table) {
            $table->id('id_document_type');
            $table->string('name', 45);
            $table->string('description', 255)->nullable();

            // Primary key constraint
            //$table->primary('id_document_type', 'DOCUMENT_TYPE_pk');
        });

        // Set owner of the table
        //DB::statement('ALTER TABLE document_types OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_type');
    }
};
