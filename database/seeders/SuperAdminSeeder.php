<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Jean Carlos Guerrel',
            'email' => 'jeanguerrel0665@gmail.com',
            'password' => Hash::make('Admin123%')
        ]);
        $superAdmin->assignRole('Super Admin');

        /*Senior */
        $superAdmin = User::create([
            'name' => 'Alejandro Sanchez',
            'email' => 'alejandro.sanchez@bahiamotors.com',
            'password' => Hash::make('Admin123%')
        ]);

        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Jean Rodriguez',
            'email' => 'jean.guerrel@bahiamotors.com',
            'password' => Hash::make('Zelda2021%')
        ]);

        $admin->assignRole('Admin');

        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'Argelis Hernandez',
            'email' => 'argelis.hernandez@bahiamotors.com',
            'password' => Hash::make('Tests123')
        ]);
        $productManager->assignRole('Product Manager');
    }
}
