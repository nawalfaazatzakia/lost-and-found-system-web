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
        User::factory()->create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'nim' => '1910050017',
            'prodi' => 'Sistem Informasi',
            'phone' => '081312345678',
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Rina Aulia',
            'email' => 'rina@example.com',
            'nim' => '1910050020',
            'prodi' => 'Sistem Informasi',
            'phone' => '081398765432',
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Admin Kampus',
            'email' => 'admin@example.com',
            'nim' => '0000000000',
            'prodi' => 'Administrator',
            'phone' => '081300000000',
            'role' => 'admin',
        ]);

        Report::factory()->count(5)->create();

        Claim::factory()->count(3)->create();

        Chat::factory()->count(6)->create();
    }
}
