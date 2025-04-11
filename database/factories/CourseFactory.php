<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => 1,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'overview' => $this->faker->paragraph,
            'thumbnail' => 'images/courses/placeholder.png',
            'badge' => 'Beginner',
            'subscription_type' => 'Free',
            'time_to_complete' => '1 Month',
            'price' => 500,
        ];
    }
}