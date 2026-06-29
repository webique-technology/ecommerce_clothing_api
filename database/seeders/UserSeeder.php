<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $customerRole = Role::where('slug', 'customer')->firstOrFail();

        $womenSection = Section::where('slug', 'women')->firstOrFail();
        $childrenSection = Section::where('slug', 'children')->firstOrFail();

        User::updateOrCreate(
            ['email' => 'womenadmin@gmail.com'],
            [
                'name' => 'Women Admin',
                'password' => Hash::make('Admin@123'),
                'role_id' => $adminRole->id,
                'section_id' => $womenSection->id,
                'status' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'childrenadmin@gmail.com'],
            [
                'name' => 'Children Admin',
                'password' => Hash::make('Admin@123'),
                'role_id' => $adminRole->id,
                'section_id' => $childrenSection->id,
                'status' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@gmail.com'],
            [
                'name' => 'Customer',
                'password' => Hash::make('Customer@123'),
                'role_id' => $customerRole->id,
                'section_id' => null,
                'status' => true,
            ]
        );
    }
}