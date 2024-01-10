<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companias')->insert([
            ['ciacod' =>'01','name' => 'Bahia Motors S.A.'],
            ['ciacod' =>'06','name' => 'Bay Motors S.A.'],
            ['ciacod' =>'02','name' => 'Sanae'],
            // Agrega más registros según sea necesario
        ]);
    }
}
