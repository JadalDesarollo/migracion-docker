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
        Schema::create('currency', function (Blueprint $table) {
            $table->id('id_currency');
            $table->string('currency_code', 255);
            $table->string('currency_type', 255);
            $table->string('simple_description', 255);
            $table->string('complete_description');
            $table->timestamps();
            //$table->softDeletes();
            //$table->primary('idcurrency', 'CURRENCY_pk');
        });

        // Seeder for currencies
        DB::table('currency')->insert([
            [
                'currency_code' => 'PEN',
                'currency_type' => 'Soles',
                'simple_description' => 'Peruvian Nuevo Sol',
                'complete_description' => 'Peruvian Nuevo Sol',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'currency_code' => 'USD',
                'currency_type' => 'Dólar Americano',
                'simple_description' => 'United States Dollar',
                'complete_description' => 'United States Dollar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'currency_code' => 'EUR',
                'currency_type' => 'Euro',
                'simple_description' => 'Euro',
                'complete_description' => 'Euro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency');
    }
};
