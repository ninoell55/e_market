<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(1)->superadmin()->create();
        User::factory()->count(2)->admin()->create();
        User::factory()->count(3)->member()->create();
    }
}
