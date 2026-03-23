<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Permissions
        Permission::firstOrCreate(['name' => 'view users']);
        Permission::firstOrCreate(['name' => 'create users']);
        Permission::firstOrCreate(['name' => 'update users']);
        Permission::firstOrCreate(['name' => 'delete users']);
        Permission::firstOrCreate(['name' => 'assign roles']);

        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // Assign permissions
        $admin->givePermissionTo(Permission::all());
        // user role has no permissions on other users (only profile access)

        // Create users
        $this->run_user();
    }

    public function run_user(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            ['name' => 'Admin', 'password' => 'password123']
        );
        $admin->assignRole('admin');

        $user = User::firstOrCreate(
            ['email' => 'user@user.com'],
            ['name' => 'User', 'password' => 'password123']
        );
        $user->assignRole('user');
    }
}
