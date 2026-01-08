<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // Role management
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            // Permission management
            'permission.view',
            'permission.create',
            'permission.edit',
            'permission.delete',

            // Peminjaman Dana
            'peminjaman-dana.view',
            'peminjaman-dana.create',
            'peminjaman-dana.edit',
            'peminjaman-dana.delete',
            'peminjaman-dana.approve',

            // Master Data
            'master-data.view',
            'master-data.create',
            'master-data.edit',
            'master-data.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo(Permission::all());

        $managerRole = Role::firstOrCreate(['name' => 'Manager', 'guard_name' => 'web']);
        $managerRole->givePermissionTo([
            'user.view',
            'peminjaman-dana.view',
            'peminjaman-dana.create',
            'peminjaman-dana.edit',
            'peminjaman-dana.approve',
            'master-data.view',
        ]);

        $staffRole = Role::firstOrCreate(['name' => 'Staff', 'guard_name' => 'web']);
        $staffRole->givePermissionTo([
            'peminjaman-dana.view',
            'peminjaman-dana.create',
            'master-data.view',
        ]);

        $debiturRole = Role::firstOrCreate(['name' => 'Debitur', 'guard_name' => 'web']);
        $debiturRole->givePermissionTo([
            'peminjaman-dana.view',
            'peminjaman-dana.create',
        ]);
    }
}
