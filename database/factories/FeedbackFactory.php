<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first(); // Get a random user
        $category = Category::inRandomOrder()->first(); // Get a random category

        return [
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => fake()->name(),
            'description' => fake()->paragraph,
            'file' => 'some-file.png',
        ];
    }
}
