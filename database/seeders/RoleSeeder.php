<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['nombre_rol' => 'Super administrador', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_rol' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_rol' => 'Usuario', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
