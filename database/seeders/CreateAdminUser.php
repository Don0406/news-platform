<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Seeder
{
    public function run()
    {
        // Create admin user if doesn't exist
        if (!User::where('email', 'admin@newshub.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@newshub.com',
                'password' => Hash::make('password123'),
            ]);
            $this->command->info('Admin user created: admin@newshub.com / password123');
        } else {
            $this->command->info('Admin user already exists');
            
            // Update password just in case
            $admin = User::where('email', 'admin@newshub.com')->first();
            $admin->password = Hash::make('password123');
            $admin->save();
            $this->command->info('Password reset to: password123');
        }
    }
}