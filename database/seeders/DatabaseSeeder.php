<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Good;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategorySeeder::class);

        $categoryIds = Category::query()->pluck('id')->all();

        Good::factory()
            ->count(10000)
            ->state(fn () => [
                'category_id' => fake()->randomElement($categoryIds),
            ])
            ->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'email@mail.com',
            'password' => Hash::make('password123456'),
        ]);
    }
}
