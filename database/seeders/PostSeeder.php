<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Define an admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('adminpassword'),
                'is_admin' => '1',
            ]
        );
        // Define preset users and their unique posts
        $users = [
            [
                'name' => 'ConcernedApe',
                'email' => 'concernedape@example.com',
                'posts' => [
                    [
                        'title' => 'Stardew Valley Future is Bright',
                        'body' => 'Stardew Valley is a beloved farming simulation game that has captured the hearts of many players. With its charming graphics, engaging gameplay, and a strong sense of community, it continues to thrive even years after its initial release.',
                        'image' => 'uploads/stardew.jpg',
                    ],
                ],
            ],
            [
                'name' => 'MojangStudios',
                'email' => 'minecraftmaster@example.com',
                'posts' => [
                    [
                        'title' => 'Chase the Skies Minecraft Game Drop Out Now!',
                        'body' => 'Chase the Skies, the second game drop of the year, has just been released. Players can explore vast worlds, ride happy ghasts, and embark on thrilling adventures with friends.',
                        'image' => 'uploads/minecraft.jpg',
                    ],
                ],
            ],
            [
                'name' => 'Nintendo',
                'email' => 'animalcrossingfan@example.com',
                'posts' => [
                    [
                        'title' => 'Animal Crossing: New Horizons - Life on the Island Gets Even Better!',
                        'body' => 'Animal Crossing: New Horizons continues to be a staple of cozy gaming, and with the latest update, it\'s become even more exciting. From new seasonal events to fresh island decorations, players can now enjoy a deeper experience with new friends, activities, and items.',
                        'image' => 'uploads/animalcrossing.png',
                    ],
                ],
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => bcrypt('password'), // Default password
                ]
            );

            foreach ($userData['posts'] as $post) {
                Post::firstOrCreate(
                    [
                        'title' => $post['title'],
                        'user_id' => $user->id,
                    ],
                    [
                        'body' => $post['body'],
                        'image' => $post['image'],
                    ]
                );
            }
        }
    }
}