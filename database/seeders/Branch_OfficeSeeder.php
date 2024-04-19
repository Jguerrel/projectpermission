<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Branch_OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('branch_offices')->insert([
            ['name' => 'Ricardo J. Alfaro','branch_id'=>1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Calle 50','branch_id'=>1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            // Agrega más registros según sea necesario
        ]);


     }
}
