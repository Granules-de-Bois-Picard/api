<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['admin', 'user'];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
                'guard_name' => 'sanctum'
            ]);
        }

        User::create([
            'first_name' => 'Alan',
            'last_name' => 'Hilarion',
            'email' => 'alan.hilarion@proton.me',
            'password' => bcrypt('password'),
        ])->assignRole('admin');

        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ])->assignRole('admin');

        $permissions = [
            'user.view.id',
            'user.view.first_name',
            'user.view.last_name',
            'user.view.email',
            'user.view.locale',
            'user.view.created_at',
            'user.view.updated_at',
            'user.view.roles',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'sanctum'
            ]);
        }

        $role = Role::findByName('admin');

        $role->syncPermissions($permissions);
    }
}
