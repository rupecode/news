<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'manage']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('view');
        $role->givePermissionTo('manage');

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('view');
    }
}
