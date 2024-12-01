<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create the owner with role 2
        User::create([
            'name' => 'Owner Name',
            'email' => 'owner@example.com',
            'password' => bcrypt('password'),
            'role' => 2, // Set role to 2 for the owner
        ]);

        // Optionally create a regular user
        User::factory()->count(10)->create(); // These users will have role 1 by default
    }
}
