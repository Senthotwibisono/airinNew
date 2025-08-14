<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $viewUsers = Permission::create(['name' => 'view users']);
        $editUsers = Permission::create(['name' => 'edit users']);

        $admin = Role::create(['name' => 'admin']);
        $user  = Role::create(['name' => 'user']);

        $admin->givePermissionTo([$viewUsers, $editUsers]);
        $user->givePermissionTo($viewUsers);
    }
}

