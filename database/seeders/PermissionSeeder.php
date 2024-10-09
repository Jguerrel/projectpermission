<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'ver-usuarios',
            'crear-usuarios',
            'editar-usuarios',
            'eliminar-usuarios',
            'crear-roles',
            'editar-roles',
            'eliminar-roles',
            'crear-permisos',
            'editar-permisos',
            'eliminar-permisos',
            'ver-permisos',
            'ver-roles',
            'crear-productos',
            'editar-productos',
            'eliminar-productos'
         ];

         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
          }
    }
}
