<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
        ]);
        // Создаем пользователя с другим email
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin2@mail.ru', // другой email
            'password' => bcrypt('password'),
        ]);

        // Создаем статьи вручную
        Article::create([
            'title' => 'Первая статья',
            'content' => 'Содержание первой статьи...',
            'preview_image' => 'preview.jpg',
            'full_image' => 'full.jpeg',
            'user_id' => $user->id,
        ]);

        Article::create([
            'title' => 'Вторая статья', 
            'content' => 'Содержание второй статьи...',
            'preview_image' => 'preview_2.jpg',
            'full_image' => 'full_2.jpeg', 
            'user_id' => $user->id,
        ]);
    }
}