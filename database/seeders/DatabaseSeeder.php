<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Category::factory(3)->create();
        \App\Models\User::factory(20)->create();
        \App\Models\Feedback::factory(30)->create();
        \App\Models\Comment::factory(110)->create();
        \App\Models\Vote::factory(110)->create();
    }
}
