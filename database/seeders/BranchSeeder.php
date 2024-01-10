<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('Branches')->insert([
            ['name' => 'Ricardo J. Alfaro','compania_id'=>1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ricardo J. Alfaro','compania_id'=>2,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            // Agrega más registros según sea necesario
        ]);


     }
}
