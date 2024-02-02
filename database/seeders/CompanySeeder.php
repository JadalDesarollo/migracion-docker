<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            Company::create([
                'identity_document_type_id' => $faker->numberBetween(1, 3),
                'number' => $faker->unique()->randomNumber(8),
                'name' => $faker->company,
                'soap_send_id' => $faker->randomElement(['01', '02', '03']),
                'soap_type_id' => $faker->randomLetter() . $faker->randomLetter(),
                'commerce_code' => $faker->randomNumber(6)
            ]);
        }

        $this->command->info('Empresas insertadas correctamente.');
    }
}
