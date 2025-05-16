<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_module_content_id' => 1,
            'question' => $this->faker->sentence(),
            'quiz_type' => 'multiple_choice',
            'options' => json_encode(['Option 1', 'Option 2', 'Option 3', 'Option 4']),
            'correct_answer' => json_encode(['Option 1']),
        ];
    }
}