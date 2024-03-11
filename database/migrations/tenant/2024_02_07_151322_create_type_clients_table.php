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
        Schema::create('type_clients', function (Blueprint $table) {
            $table->id('id_type_client');
            $table->string('name');
            $table->string('description')->nullable();

            // Primary key constraint
            //$table->primary('id_type_client', 'type_client_pk');
        });

        // Set owner of the table
        //DB::statement('ALTER TABLE type_clients OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_clients');
    }
};
