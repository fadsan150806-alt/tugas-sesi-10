<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Membuat permission
        $permissions = [
            'books.view',
            'books.create',
            'books.edit',
            'books.delete',
            'users.manage_roles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // Membuat role
        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $dosen = Role::firstOrCreate([
            'name' => 'Dosen',
            'guard_name' => 'web',
        ]);

        $mahasiswa = Role::firstOrCreate([
            'name' => 'Mahasiswa',
            'guard_name' => 'web',
        ]);

        // Hak akses Admin
        $admin->syncPermissions($permissions);

        // Hak akses Dosen
        $dosen->syncPermissions([
            'books.view',
            'books.create',
            'books.edit',
        ]);

        // Hak akses Mahasiswa
        $mahasiswa->syncPermissions([
            'books.view',
        ]);

        // Membuat akun pengujian
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => 'password123',
                'role' => 'Admin',
            ],
            [
                'name' => 'Dosen Penguji',
                'email' => 'dosen@gmail.com',
                'password' => 'password123',
                'role' => 'Dosen',
            ],
            [
                'name' => 'Mahasiswa Penguji',
                'email' => 'mahasiswa@gmail.com',
                'password' => 'password123',
                'role' => 'Mahasiswa',
            ],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make($data['password']),
                ]
            );

            $user->syncRoles([$data['role']]);
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
