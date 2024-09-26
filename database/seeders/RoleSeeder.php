<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $productManager = Role::create(['name' => 'Product Manager']);

        $admin->givePermissionTo([
            'crear-usuarios',
            'editar-usuarios',
            'eliminar-usuarios',
            'crear-roles',
            'editar-roles',
            'eliminar-roles'
        ]);

        $productManager->givePermissionTo([
            'crear-productos',
            'editar-productos',
            'eliminar-productos'
        ]);
    }
}
