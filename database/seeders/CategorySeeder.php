<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::query()->insert([
            ['name' => 'Electronics'],
            ['name' => 'Clothing and footwear'],
            ['name' => 'Home goods'],
            ['name' => 'Foods'],
            ['name' => 'Automotive products'],
        ]);
    }
}
