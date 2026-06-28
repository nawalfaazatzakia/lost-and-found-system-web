<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Claim;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Chat>
 */
class ChatFactory extends Factory
{
    protected $model = Chat::class;

    public function definition(): array
    {
        return [
            'claim_id' => Claim::factory(),
            'sender_id' => User::factory(),
            'message' => fake()->sentence(10),
        ];
    }
}
