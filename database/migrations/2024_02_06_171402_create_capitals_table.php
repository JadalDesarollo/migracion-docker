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
        Schema::create('capitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state');
            $table->string('name');
            $table->double('population');
            $table->integer('altitude')->comment('In Feet');
            $table->timestamps();
        });

        // Ejecuta SQL puro para agregar herencia
        DB::statement('ALTER TABLE capitals INHERIT cities;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capitals');
    }
};
