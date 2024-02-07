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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id('idvehicle');
            $table->string('vehicle_plate', 45);

            // Primary key constraint
            //$table->primary('idvehicle', 'VEHICLE_pk');
        });

        // Set owner of the table
        //DB::statement('ALTER TABLE vehicles OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
