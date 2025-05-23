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
            'title' => $this->faker->title,
            'description' => $this->faker->paragraph,
            'overview' => $this->faker->paragraph(nbSentences: 6)."\n\n".$this->faker->paragraph(6)."\n\n".$this->faker->paragraph(6),
            'thumbnail' => 'images/courses/placeholder.png',
            'badge_id' => $this->faker->numberBetween(1, 3),
            'time_to_complete' => '1 Month',
            'price' => 0,
            'category_id'=> $this->faker->numberBetween(1,5),
        ];
    }
}