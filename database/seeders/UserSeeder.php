<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'email@mail.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password123456'),
                'email_verified_at' => now(),
            ]
        );
    }
}
