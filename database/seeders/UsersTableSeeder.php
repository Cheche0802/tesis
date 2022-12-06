<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //  Permission::truncate();
       // Role::truncate();
        //User::truncate();

        $adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);
        $writerRole = Role::create(['name' => 'Writer', 'display_name' => 'Escritor']);

        $viewPostsPermission = Permission::create([
            'name' => 'Ver publicaciones',
            'display_name' => 'Ver publicaciones'
        ]);
        $createPostsPermission = Permission::create([
            'name' => 'Crear publicaciones',
            'display_name' => 'Crear publicaciones'
        ]);
        $updatePostsPermission = Permission::create([
            'name' => 'Actualizar publicaciones',
            'display_name' => 'Actualizar publicaciones'
        ]);
        $deletePostsPermission = Permission::create([
            'name' => 'Borrar publicaciones',
            'display_name' => 'Eliminar publicaciones'
        ]);

        $viewUsersPermission = Permission::create([
            'name' => 'Ver Usuario',
            'display_name' => 'Ver usuarios'
        ]);
        $createUsersPermission = Permission::create([
            'name' => 'Crear Usuario',
            'display_name' => 'Crear usuarios'
        ]);
        $updateUsersPermission = Permission::create([
            'name' => 'Actualizar Usuario',
            'display_name' => 'Actualizar usuarios'
        ]);
        $deleteUsersPermission = Permission::create([
            'name' => 'Borrar Usuario',
            'display_name' => 'Eliminar usuarios'
        ]);

        $viewRolesPermission = Permission::create([
            'name' => 'Ver Roles',
            'display_name' => 'Ver Roles'
        ]);
        $createRolesPermission = Permission::create([
            'name' => 'Crear Roles',
            'display_name' => 'Crear Roles'
        ]);
        $updateRolesPermission = Permission::create([
            'name' => 'Actualizar Roles',
            'display_name' => 'Actualizar Roles'
        ]);
        $deleteRolesPermission = Permission::create([
            'name' => 'Borar Roles',
            'display_name' => 'Eliminar Roles'
        ]);

        $viewPermissionsPermission = Permission::create([
            'name' => 'Ver Permisos',
            'display_name' => 'Ver permisos'
        ]);
        $updatePermissionsPermission = Permission::create([
            'name' => 'Actualizar Permisos',
            'display_name' => 'Actualizar permisos'
        ]);

        $admin = new User;
        $admin->name = 'Jorge';
        $admin->email = 'jorge@aprendible.com';
        $admin->password = '123123';
        $admin->save();

        $admin->assignRole($adminRole);

        $writer = new User;
        $writer->name = 'Luis';
        $writer->email = 'luis@aprendible.com';
        $writer->password = '123123';
        $writer->save();

        $writer->assignRole($writerRole);
    }
}





