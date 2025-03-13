<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $cant = 20;

        for ($i = 0; $i < $cant; $i++) {
            DB::table('usuarios')->insert([
                [
                    'nombre' => $faker->firstName(),
                    'app' => $faker->lastName(),
                    'apm' => $faker->lastName(),
                    'fn' => $faker->date(),
                    'telefono' => $faker->phoneNumber(),
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make('password123'),
                ],
            ]);
        }
    }
}
