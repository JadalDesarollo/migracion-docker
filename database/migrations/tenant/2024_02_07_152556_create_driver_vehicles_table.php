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
        Schema::create('driver_vehicle', function (Blueprint $table) {
            $table->id('id_driver_vehicle');
            $table->unsignedBigInteger('idvehicle');
            $table->unsignedBigInteger('iddriver');

            // Primary key constraint
            //$table->primary('id_driver_vehicle', 'id_driver_vehicle_pk');

            // Foreign key constraints
            //$table->foreign('idvehicle')->references('idvehicle')->on('vehicles')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('iddriver')->references('iddriver')->on('drivers')->onDelete('cascade')->onUpdate('cascade');
        });

        // Set owner of the table
        //DB::statement('ALTER TABLE id_driver_vehicles OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_vehicle');
    }
};
