<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['name' => 'Administracion Contabilidad','created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Administracion CSC & IT','created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Administracion Gerencia','created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Administracion RRHH','created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Operaciones','created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Repuesto','created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Taller','created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ventas Motos','created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ventas y Mercadeo','created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            // Agrega más registros según sea necesario
        ]);
    }
}
