<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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
