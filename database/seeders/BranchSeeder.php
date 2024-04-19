<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            ['name' => 'Bahia Motors S.A.'],
            ['name' => 'Bay Motors S.A.'],
            ['name' => 'Sanae'],
            // Agrega más registros según sea necesario
        ]);
    }
}
