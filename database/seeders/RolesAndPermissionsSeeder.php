<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        // $roleUser = Role::create(['name' => 'user']);

        $permissionView = Permission::create(['name' => 'view posts']);
        $permissionEdit = Permission::create(['name' => 'edit posts']);

        $roleAdmin->givePermissionTo($permissionView);
        $roleAdmin->givePermissionTo($permissionEdit);

        // $roleUser->givePermissionTo($permissionView);
    }
}
