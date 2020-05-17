<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        app()['cache']->forget('spatie.permission.cache');

        //Creacion de permisos sobre el crud del usuario
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'read user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        //Creacion de rol y asignacion de permisos al rol de "administrador"
        $role = Role::create(['name' => 'administrador']);
        //permisos CRUD de usuario, todos los permisos
        $role->givePermissionTo('create user');
        $role->givePermissionTo('read user');
        $role->givePermissionTo('update user');
        $role->givePermissionTo('delete user');

        //Creacion de rol y asignacion de permisos al rol de "secretaria de escuela"
        $role = Role::create(['name' => 'secretaria de escuela']);
        //Solo puede crear y ver los usuarios
        $role->givePermissionTo('create user');
        $role->givePermissionTo('read user');


        //Creacion de rol y asignacion de permisos al rol de "profesor"
        $role = Role::create(['name' => 'profesor']);
        //No posee permisos sobre los usuarios


    }
}
