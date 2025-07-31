<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Define preset users
        $users = [
            [
                'name' => 'ConcernedApe',
                'email' => 'concernedape@example.com',
            ],
            [
                'name' => 'MojangStudios',
                'email' => 'minecraftmaster@example.com',
            ],
            [
                'name' => 'Nintendo',
                'email' => 'animalcrossingfan@example.com',
            ],
        ];

         // Insert preset users into the database
        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt('password'), // Default password
            ]);

            // Define posts for each user
            $posts = [
                [
                    'title' => 'Stardew Valley Future is Bright',
                    'body' => 'Stardew Valley is a beloved farming simulation game that has captured the hearts of many players. With its charming graphics, engaging gameplay, and a strong sense of community, it continues to thrive even years after its initial release.',
                    'user_id' => $user->id,  // Link to the current user
                    'image' => 'uploads/stardew.jpg',
                ],
                [
                    'title' => 'Chase the Skies Minecraft Game Drop Out Now!',
                    'body' => 'Chase the Skies, the second game drop of the year, has just been released. Players can explore vast worlds, ride happy ghasts, and embark on thrilling adventures with friends.',
                    'user_id' => $user->id,  // Link to the current user
                    'image' => 'uploads/minecraft.jpg',
                ],
                [
                    'title' => 'Animal Crossing: New Horizons - Life on the Island Gets Even Better!',
                    'body' => 'Animal Crossing: New Horizons continues to be a staple of cozy gaming, and with the latest update, it\'s become even more exciting. From new seasonal events to fresh island decorations, players can now enjoy a deeper experience with new friends, activities, and items.',
                    'user_id' => $user->id,  // Link to the current user
                    'image' => 'uploads/animalcrossing.png',
                ],
            ];

            // Insert the posts for the current user
            foreach ($posts as $post) {
                Post::create($post);
            }
        }
    }
}