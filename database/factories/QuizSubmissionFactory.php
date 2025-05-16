<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuizSubmission>
 */
class QuizSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quiz_id' => 1,
            'user_id' => 1,
            'answers' => '{
                "1": "Option 1",
                "2": "Option 1"
                "3": "Option 1"
            }',
            'score' => 3,
        ];
    }
}