<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('usuarios')->insert([
            'id_rol' => 1, 
            'nombre_usuario' => env('NOMBRE'),
            'apellido_usuario' => env('APELLIDO'),
            'email_usuario' => env('EMAIL'),
            'password_usuario' => Hash::make(env('PASSWORD')),
            'fecha_registro' => now(),
            'estado_usuario' => 'activo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
