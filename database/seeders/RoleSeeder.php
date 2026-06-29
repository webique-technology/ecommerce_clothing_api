<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::updateOrCreate(
            ['slug' => 'admin'],
            [
                'name' => 'Admin',
                'status' => true,
            ]
        );

        Role::updateOrCreate(
            ['slug' => 'customer'],
            [
                'name' => 'Customer',
                'status' => true,
            ]
        );
    }
}