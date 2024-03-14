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
        Schema::create('type_client', function (Blueprint $table) {
            $table->id('id_type_client');
            $table->string('name');
            $table->string('description')->nullable();

            // Primary key constraint
            //$table->primary('id_type_client', 'type_client_pk');
            $table->timestamps();
        });

        // Set owner of the table
        //DB::statement('ALTER TABLE type_clients OWNER TO postgres');

        // Insertar datos por defecto en la tabla type_client
        DB::table('type_client')->insert([
            'name' => 'type 1',
            'description' => 'descripción tipo test'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_client');
    }
};
