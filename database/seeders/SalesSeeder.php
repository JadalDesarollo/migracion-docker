<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Limpiar las tablas antes de insertar nuevos datos
        // DB::table('user_views')->truncate();
        // DB::table('employees')->truncate();
        // DB::table('transactions')->truncate();
        // DB::table('products')->truncate();
        // DB::table('sales')->truncate();
        // DB::table('sale_details')->truncate();

        // Insertar datos en la tabla user_views
        foreach (range(1, 100) as $index) {
            DB::table('user_views')->insert([
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insertar datos en la tabla employees
        foreach (range(1, 50) as $index) {
            DB::table('employees')->insert([
                'id_person' => $faker->unique()->randomNumber(5),
                'id_user_view' => $faker->numberBetween(1, 100), // Utilizar valores existentes de user_views
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'address' => $faker->streetAddress,
                'document_number' => $faker->isbn10,
                'telphone_number' => $faker->phoneNumber,
                'email' => $faker->email,
                'state' => $faker->boolean,
                'date_of_birth' => $faker->date,
                'creation_date' => $faker->date,
                'id_document_type' => $faker->numberBetween(1, 10), // Suponiendo que tienes 10 tipos de documentos
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insertar datos en la tabla transactions
        foreach (range(1, 100) as $index) {
            DB::table('transactions')->insert([
                'id_user_view' => $faker->numberBetween(1, 100), // Utilizar valores existentes de user_views
                'id_employee' => $faker->numberBetween(1, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insertar datos en la tabla products
        foreach (range(1, 50) as $index) {
            DB::table('products')->insert([
                'description' => $faker->sentence(3),
                'foreign_name' => $faker->word(),
                'product_code' => $faker->unique()->ean8(),
                'state' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insertar datos en la tabla sales
        foreach (range(1, 50) as $index) {
            DB::table('sales')->insert([
                'pos_id' => $faker->unique()->randomNumber(5),
                'date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'id_sales_reference' => $faker->numberBetween(1, 50),
                'state' => $faker->randomElement(['pending', 'completed', 'cancelled']),
                'id_transaction' => $faker->numberBetween(1, 100),
                'id_user_view' => $faker->numberBetween(1, 100), // Utilizar valores existentes de user_views
                'id_employee' => $faker->numberBetween(1, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insertar datos en la tabla sale_details
        foreach (range(1, 50) as $index) {
            DB::table('sale_details')->insert([
                'total_amount' => $faker->randomFloat(2, 10, 100),
                'quantity' => $faker->randomNumber(2),
                'detail_tax' => json_encode(['tax' => $faker->randomFloat(2, 0, 10)]),
                'id_product' => $faker->numberBetween(1, 20), // Suponiendo que tienes 20 productos
                'id_sales' => $faker->numberBetween(1, 50), // Suponiendo que tienes 50 ventas
                'subtotal' => $faker->randomFloat(2, 10, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
