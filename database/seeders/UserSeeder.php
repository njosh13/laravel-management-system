<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $adminUser = User::where('email', 'admin@test.com')->firstOr(
            function () {
                return User::factory()->create([
                    'name' => 'Admin User',
                    'email' => 'admin@test.com',
                ]);
            }
        );

        $adminUser->roles()->sync(Role::where('name', 'Admin')->first()->id);

        // Create Normal User
        $user2  = User::where('email', 'user@test.com')->firstOr(
            function () {
                return User::factory()->create([
                    'name' => 'Normal User',
                    'email' => 'user@test.com',
                ]);
            }
        );

        $user2->roles()->sync(Role::where('name', 'User')->first()->id);
    }
}
