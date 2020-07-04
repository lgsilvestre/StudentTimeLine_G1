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

        //---------------- creacion de permisos ----------------

        //Creacion de permisos sobre el crud del usuario
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'read user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'restore user']);
        //Creacion de permisos sobre el crud del escuela
        Permission::create(['name' => 'create escuela']);
        Permission::create(['name' => 'read escuela']);
        Permission::create(['name' => 'update escuela']);
        Permission::create(['name' => 'delete escuela']);
        Permission::create(['name' => 'restore escuela']);
        //Creacion de permisos sobre el crud del curso
        Permission::create(['name' => 'create curso']);
        Permission::create(['name' => 'read curso']);
        Permission::create(['name' => 'update curso']);
        Permission::create(['name' => 'delete curso']);
        Permission::create(['name' => 'restore curso']);
        //Creacion de permisos sobre el crud del estudiante
        Permission::create(['name' => 'create estudiante']);
        Permission::create(['name' => 'read estudiante']);
        Permission::create(['name' => 'update estudiante']);
        Permission::create(['name' => 'delete estudiante']);
        Permission::create(['name' => 'restore estudiante']);
        //Importar
        Permission::create(['name' => 'importar estudiante']);
        //Exportar
        Permission::create(['name' => 'exportar estudiante']);
        //---------------- asignacion de permisos ----------------

        //Creacion de rol y asignacion de permisos al rol de "administrador"
        $role = Role::create(['name' => 'admin']);
        //permisos CRUD de usuario, todos los permisos
        $role->givePermissionTo('create user');
        $role->givePermissionTo('read user');
        $role->givePermissionTo('update user');
        $role->givePermissionTo('delete user');
        $role->givePermissionTo('restore user');
        //permisos CRUD de escuela, todos los permisos
        $role->givePermissionTo('create escuela');
        $role->givePermissionTo('read escuela');
        $role->givePermissionTo('update escuela');
        $role->givePermissionTo('delete escuela');
        $role->givePermissionTo('restore escuela');
        //permisos CRUD de curso, todos los permisos
        $role->givePermissionTo('create curso');
        $role->givePermissionTo('read curso');
        $role->givePermissionTo('update curso');
        $role->givePermissionTo('delete curso');
        $role->givePermissionTo('restore curso');
        //permisos CRUD de estudiante, todos los permisos
        $role->givePermissionTo('create estudiante');
        $role->givePermissionTo('read estudiante');
        $role->givePermissionTo('update estudiante');
        $role->givePermissionTo('delete estudiante');
        $role->givePermissionTo('restore estudiante');
        //Puede exportar e importar
        $role->givePermissionTo('importar estudiante');
        $role->givePermissionTo('exportar estudiante');

        //Creacion de rol y asignacion de permisos al rol de "secretaria de escuela"
        $role = Role::create(['name' => 'secretaria de escuela']);
        //Solo puede modificarse asi mismo y ver los usuarios
        $role->givePermissionTo('update user');
        $role->givePermissionTo('read user');
        $role->givePermissionTo('restore user');
        //Solo puede ver las escuelas
        $role->givePermissionTo('read escuela');
        //permisos CRUD de curso, todos los permisos
        $role->givePermissionTo('create curso');
        $role->givePermissionTo('read curso');
        $role->givePermissionTo('update curso');
        $role->givePermissionTo('delete curso');
        $role->givePermissionTo('restore curso');
        //permisos CRUD de estudiante, todos los permisos
        $role->givePermissionTo('create estudiante');
        $role->givePermissionTo('read estudiante');
        $role->givePermissionTo('update estudiante');
        $role->givePermissionTo('delete estudiante');
        $role->givePermissionTo('restore estudiante');
        //Puede exportar e importar
        $role->givePermissionTo('importar estudiante');
        $role->givePermissionTo('exportar estudiante');
        //Creacion de rol y asignacion de permisos al rol de "profesor"
        $role = Role::create(['name' => 'profesor']);
        //Puede modificar su propio usuario
        $role->givePermissionTo('update user');
        //Puede ver el listado de las escuelas
        $role->givePermissionTo('read escuela');
        //Solo puede ver a los estudiantes
        $role->givePermissionTo('read estudiante');
        //Solo puede exportar, no importar
        $role->givePermissionTo('exportar estudiante');
    }
}
