<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6),
            'content' => $this->faker->paragraphs(3, true),
            'preview_image' => 'preview_' . $this->faker->numberBetween(1, 2) . '.jpg',
            'full_image' => 'full_' . $this->faker->numberBetween(1, 2) . '.jpeg',
            'user_id' => User::factory(),
        ];
    }
}