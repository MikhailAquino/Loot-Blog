<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $images = Storage::disk('public')->files('uploads');

        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'image' => count($images) ? $this->faker->randomElement($images) : null,
        ];
    }
}