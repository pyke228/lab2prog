<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Очищаем таблицу сначала (опционально)
        // Role::truncate();

        $roles = [
            ['name' => 'moderator', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'reader', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($roles as $role) {
            // Используем insert ignore для избежания дубликатов
            DB::table('roles')->insertOrIgnore($role);
        }

        $this->command->info('Roles seeded successfully!');
    }
}