<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AttachPermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // @TODO: a mettre dans les migrations
        $role = Role::findByName("ADMIN");
        $permissions = Permission::whereIn('name', ['create_dishes', 'delete_dishes'])->get();

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }
    }
}
