<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $feedback = Feedback::inRandomOrder()->first();
        $type = fake()->randomElement(['upvote', 'downvote']);

        return [
            'user_id' => $user->id,
            'feedback_id' => $feedback->id,
            'type' => $type,
        ];
    }
}
