<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@newshub.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Create editor user
        User::create([
            'name' => 'Editor',
            'email' => 'editor@newshub.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Create reporter user
        User::create([
            'name' => 'Reporter',
            'email' => 'reporter@newshub.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Create test users
        User::factory()->count(5)->create();
    }
}