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
        Schema::create('card', function (Blueprint $table) {
            $table->id('id_card');
            $table->string('name');
            $table->string('description');
            $table->string('bank');
            //$table->smallInteger('bank');
            $table->timestamps();

            // Primary key constraint
            //$table->primary('id_card');

            // If you want to create indexes or unique constraints, you can define them here
            // $table->index('name');
            // $table->unique('name');
        });

        // Seeder for cards
        DB::table('card')->insert([
            [
                'name' => 'Visa',
                'description' => 'Visa',
                'bank' => 'bank',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mastercard',
                'description' => 'Mastercard',
                'bank' => 'bank',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        // Set owner of the table
        // DB::statement('ALTER TABLE cards OWNER TO postgres');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card');
    }
};
