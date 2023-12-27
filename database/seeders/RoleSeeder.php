<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'User'],
        ];

        $roles = collect($roles)->map(function ($attributes) {
            $roleName = $attributes['name'];

            // Check if the role already exists in the database
            $role = Role::where('name', $roleName)->first();

            // If the role exists, return it; otherwise, create a new role
            return $role ? $role : Role::create($attributes);
        });
    }
}
