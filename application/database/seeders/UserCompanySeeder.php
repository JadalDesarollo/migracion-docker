<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = DB::table('companies')->first();

        if ($company) {
            $company_id = $company->id;

            $user_ids = DB::table('users')->pluck('id');

            foreach ($user_ids as $user_id) {

                $rol_id = 1;

                DB::table('company_user_rol')->insert([
                    'user_id' => $user_id,
                    'company_id' => $company_id,
                    'rol_id' => $rol_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
