<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\User::factory()->create([
                'name' => 'Test User',
                'email' => 'test.proxy@mailinator.com',
                'password' => Hash::make('test'),
                'email_verified_at' => now(),
            ]);
        } catch (\Exception) {
            echo 'Test user already exists' . PHP_EOL;
        }
    }
}
