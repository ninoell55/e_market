<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Pest\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'role' => 'superadmin',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Nino Adityo Nugroho',
            'username' => 'nino',
            'email' => 'nino@example.com',
            'email_verified_at' => now(),
            'role' => 'member',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Jihan Syahira',
            'username' => 'jihan',
            'email' => 'jihan@example.com',
            'email_verified_at' => now(),
            'role' => 'member',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);

        User::factory()->count(1)->superadmin()->create();
        User::factory()->count(2)->admin()->create();
        User::factory()->count(3)->member()->create();
    }
}
