<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RoleSeeder::class);

        $user = User::firstOrCreate(
            ['email' => 'moderator@example.com'],
            [
                'name' => 'Moderator User',
                'password' => Hash::make('password'),
            ]
        );


        $user->roles()->sync([1]); // ID роли модератора

        if (Article::count() === 0) {
            Article::create([
                'title' => 'Первая статья',
                'content' => 'Содержание первой статьи...',
                'preview_image' => 'preview1.jpg',
                'full_image' => 'full1.jpg',
                'user_id' => $user->id,
            ]);

            Article::create([
                'title' => 'Вторая статья',
                'content' => 'Содержание второй статьи...',
                'preview_image' => 'preview2.jpg', 
                'full_image' => 'full2.jpg',
                'user_id' => $user->id,
            ]);

            Article::create([
                'title' => 'Новости разработки',
                'content' => 'Последние новости в мире веб-разработки...',
                'preview_image' => 'preview3.jpg',
                'full_image' => 'full3.jpg',
                'user_id' => $user->id,
            ]);
        }

        $this->command->info('Database seeded successfully!');
    }
}