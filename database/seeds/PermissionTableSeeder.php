<?php


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions = [
           'Ver roles',
           'Crear roles',
           'Editar roles',
           'Eliminar roles',
           'Ver usuarios',
           'Crear usuarios',
           'Editar usuarios',
           'Eliminar usuarios',
           'Ver instituciones',
           'Crear instituciones',
           'Editar instituciones',
           'Eliminar instituciones',
           'Ver pacientes',
           'Crear pacientes',
           'Editar pacientes',
           'Eliminar pacientes'
        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
