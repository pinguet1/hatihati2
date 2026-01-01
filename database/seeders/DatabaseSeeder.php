<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create();

        User::factory()->create([
            'name' => 'Angello',
            'email' => 'admin@admin.com',
            'password' => 'hello'
        ]);

        User::factory()->create([
            'name' => 'Mich',
            'email' => 'admin2@admin.com',
            'password' => 'hello'
        ]);
    }
}
