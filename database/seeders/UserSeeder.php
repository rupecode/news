<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make(env('DEFAULT_PASSWORD')),
            ]);
        } catch (\Throwable $e) {

        }

        $user = User::query()->where('email', '=', 'user@example.com')->first();

        if (!$user) {
            $user = User::factory()->create([
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => Hash::make(env('DEFAULT_PASSWORD')),
            ]);
        }

        $user->assignRole('user');

        $user = User::query()->where('email', '=', 'admin@example.com')->first();

        if(!$user) {
            $user = User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make(env('DEFAULT_PASSWORD')),
            ]);
        }

        $user->assignRole('admin');

    }
}
