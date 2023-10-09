<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first(); // Get a random user
        $user_name = User::pluck('name')->random(); // Get a random user
        $feedback = Feedback::inRandomOrder()->first(); // Get a random feedback

        return [
            'user_id' => $user->id,
            'feedback_id' => $feedback->id,
            'content' => '{"ops":[{"insert":"simple"},{"attributes":{"bold":true},"insert":"Bold"},{"insert":null},{"attributes":{"italic":true},"insert":"Italics"},{"insert":null},{"attributes":{"underline":true,"italic":true},"insert":"underline"},{"insert":"asdas"},{"attributes":{"code-block":true},"insert":null},{"insert":null}]}',
            'text' => '@'.$user_name. ' '. fake()->sentence()
        ];
    }
}
