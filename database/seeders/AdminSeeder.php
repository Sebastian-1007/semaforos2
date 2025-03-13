<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'nombre' => 'Administrador',
            'email' => 'admin@semaforo.com',
            'password' => Hash::make('admin123@'),
        ]);
    }
}
