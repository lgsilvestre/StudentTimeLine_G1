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
        //Creacion de permisos sobre el crud del escuela
        Permission::create(['name' => 'create escuela']);
        Permission::create(['name' => 'read escuela']);
        Permission::create(['name' => 'update escuela']);
        Permission::create(['name' => 'delete escuela']);

        //Creacion de rol y asignacion de permisos al rol de "administrador"
        $role = Role::create(['name' => 'admin']);
        //permisos CRUD de usuario, todos los permisos
        $role->givePermissionTo('create user');
        $role->givePermissionTo('read user');
        $role->givePermissionTo('update user');
        $role->givePermissionTo('delete user');
        //permisos CRUD de escuela, todos los permisos
        $role->givePermissionTo('create escuela');
        $role->givePermissionTo('read escuela');
        $role->givePermissionTo('update escuela');
        $role->givePermissionTo('delete escuela');

        //Creacion de rol y asignacion de permisos al rol de "secretaria de escuela"
        $role = Role::create(['name' => 'secretaria de escuela']);
        //Solo puede crear y ver los usuarios
        $role->givePermissionTo('create user');
        $role->givePermissionTo('read user');
        //No posee permisos sobre la carrera

        //Creacion de rol y asignacion de permisos al rol de "profesor"
        $role = Role::create(['name' => 'profesor']);
        //No posee permisos sobre la carrera
        


    }
}
