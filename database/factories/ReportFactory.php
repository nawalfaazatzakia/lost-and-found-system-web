<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Report>
 */
class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition(): array
    {
        $types = ['lost', 'found'];
        $statuses = ['pending', 'approved', 'claimed', 'completed'];

        return [
            'user_id' => User::factory(),
            'item_name' => fake()->words(fake()->numberBetween(2, 4), true),
            'type' => fake()->randomElement($types),
            'category' => fake()->randomElement(['Elektronik', 'Dompet', 'Tas', 'Kunci', 'Dokumen', 'Aksesoris']),
            'description' => fake()->sentence(12),
            'location' => fake()->address(),
            'date' => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'image' => null,
            'status' => fake()->randomElement($statuses),
        ];
    }
}
