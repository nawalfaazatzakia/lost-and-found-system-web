<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Claim;
use App\Models\Report;
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
        // Create default users if they do not exist
        User::firstOrCreate([
            'nim' => '1910050017'
        ], [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'prodi' => 'Sistem Informasi',
            'phone' => '081312345678',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);

        User::firstOrCreate([
            'nim' => '1910050020'
        ], [
            'name' => 'Rina Aulia',
            'email' => 'rina@example.com',
            'prodi' => 'Sistem Informasi',
            'phone' => '081398765432',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);

        User::firstOrCreate([
            'nim' => '0000000000'
        ], [
            'name' => 'Admin Kampus',
            'email' => 'admin@example.com',
            'prodi' => 'Administrator',
            'phone' => '081300000000',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // Only create sample reports/claims/chats if none exist yet
        if (Report::count() === 0) {
            Report::factory()->count(5)->create();
        }

        if (Claim::count() === 0) {
            Claim::factory()->count(3)->create();
        }

        if (Chat::count() === 0) {
            Chat::factory()->count(6)->create();
        }
    }
}
