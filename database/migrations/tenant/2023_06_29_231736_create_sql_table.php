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
        // Obtener la ruta completa del archivo SQL
        $sqlFile = __DIR__ . '/database-and-tables.sql';

        // Verificar si el archivo existe
        if (file_exists($sqlFile)) {
            // Obtener el contenido del archivo SQL
            $sqlContent = file_get_contents($sqlFile);

            try {
                // Ejecutar el contenido del archivo SQL
                DB::unprepared($sqlContent);
                DB::statement('ALTER TABLE public.person_address DROP CONSTRAINT IF EXISTS person_fk CASCADE;');
            } catch (\Exception $e) {
                // Manenvejar la excepción (puedes mostrar un mensaje de error o simplemente ignorarla)
                // En este caso, se ignorará la excepción
                // Puedes añadir un registro de log si deseas registrar esta excepción para futuras referencias
            }
        } else {
            // Mostrar un mensaje si el archivo no existe
            echo "El archivo SQL no se encontró: $sqlFile";
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
