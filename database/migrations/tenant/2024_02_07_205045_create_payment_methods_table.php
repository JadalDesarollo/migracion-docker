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
        Schema::create('payment_method', function (Blueprint $table) {
            $table->smallInteger('id_payment_method')->primary();
            $table->string('name', 45)->nullable();
            $table->string('description', 255)->nullable();
            $table->timestamps();
        });

        // Seeder for payment_methods
        DB::table('payment_method')->insert([
            [
                'id_payment_method' => '01',
                'name' => 'Efectivo',
                'description' => 'Efectivo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_payment_method' => '02',
                'name' => 'Tarjeta de crédito',
                'description' => 'Tarjeta de crédito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_payment_method' => '03',
                'name' => 'Tarjeta de débito',
                'description' => 'Tarjeta de débito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_payment_method' => '04',
                'name' => 'Transferencia',
                'description' => 'Transferencia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_payment_method' => '06',
                'name' => 'Tarjeta crédito visa',
                'description' => 'Tarjeta crédito visa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_payment_method' => '07',
                'name' => 'Contado contraentrega',
                'description' => 'Contado contraentrega',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_payment_method' => '08',
                'name' => 'A 30 días',
                'description' => 'A 30 días',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_payment_method' => '09',
                'name' => 'Crédito',
                'description' => 'Crédito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_payment_method' => '10',
                'name' => 'Contado',
                'description' => 'Contado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_payment_method' => '14',
                'name' => 'Yape',
                'description' => 'Yape',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_payment_method' => '15',
                'name' => 'Plin',
                'description' => 'Plin',
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
        Schema::dropIfExists('payment_method');
    }
};
