<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Создаем роли
        $moderatorRole = Role::create(['name' => 'moderator']);
        $readerRole = Role::create(['name' => 'reader']);

        // Создаем модератора
        User::create([
            'name' => 'Moderator',
            'email' => 'moderator@mail.ru',
            'password' => Hash::make('password'),
            'role_id' => $moderatorRole->id,
        ]);

        // Обновляем существующих пользователей на роль reader
        User::whereNull('role_id')->update(['role_id' => $readerRole->id]);
    }
}