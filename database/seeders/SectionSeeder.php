<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        Section::updateOrCreate(
            ['slug' => 'women'],
            [
                'name' => 'Women',
                'status' => true,
            ]
        );

        Section::updateOrCreate(
            ['slug' => 'children'],
            [
                'name' => 'Children',
                'status' => true,
            ]
        );
    }
}