<?php

namespace Database\Factories;

use App\Models\Claim;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Claim>
 */
class ClaimFactory extends Factory
{
    protected $model = Claim::class;

    public function definition(): array
    {
        return [
            'report_id' => Report::factory()->state(fn (array $attributes) => [
                'type' => 'found',
                'status' => 'approved',
            ]),
            'claimer_id' => User::factory(),
            'claim_reason' => fake()->sentence(8),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
