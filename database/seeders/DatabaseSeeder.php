<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create pasien
        for ($i = 0; $i < 10; $i++) {
            $first_name = fake()->firstName();
            $last_name = fake()->lastName();
            $name = $first_name . ' ' . $last_name;
            $email = Str::snake($name);
            $email = Str::replace([',', '.', '\''], '', $email);

            DB::table('users')->insert([
                'name' => $name,
                'email' => $email.'@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role' => 'pasien',
                'remember_token' => uniqid(),
            ]);
        }

        // Create dokter
        for ($i = 0; $i < 10; $i++) {
            $first_name = fake()->firstName();
            $last_name = fake()->lastName();
            $name = $first_name . ' ' . $last_name;
            $email = Str::snake($name);
            $email = Str::replace([',', '.', '\''], '', $email);

            DB::table('users')->insert([
                'name' => $name,
                'email' => $email.'@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role' => 'dokter',
                'remember_token' => uniqid(),
            ]);
        }

        // Create rekam medis
        \App\Models\RekamMedis::factory(20)->create();
    }
}
