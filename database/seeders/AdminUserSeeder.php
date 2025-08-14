<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role admin sudah ada, jika belum buat
        $role = Role::firstOrCreate(['name' => 'admin']);

        // Cek apakah user sudah ada
        $user = User::firstOrCreate(
            ['email' => 'admin@role.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('12345678'),
            ]
        );

        // Assign role admin ke user
        if (!$user->hasRole('admin')) {
            $user->assignRole($role);
        }
    }
}
