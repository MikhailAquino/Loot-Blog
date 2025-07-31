<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the users only once
        $users = User::factory(3)->create(); // Create 3 users

        // Call the PostSeeder and pass the users
        $this->call(PostSeeder::class);
    }
}