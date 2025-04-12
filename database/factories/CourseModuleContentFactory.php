<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseModuleContent>
 */
class CourseModuleContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_module_id' => 1,
            'title' => $this->faker->sentence,
            'content' => 
            "<h4>".$this->faker->sentence."</h4>"
            ."<p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p>"
            ."&nbsp;<h4>".$this->faker->sentence."</h4>"
            ."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p>"
            ."&nbsp;<h4>".$this->faker->sentence."</h4>"
            ."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p>"
            ."&nbsp;<h4>".$this->faker->sentence."</h4>"
            ."<p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p>"
            ."&nbsp;<h4>".$this->faker->sentence."</h4>"
            ."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p>"
            ."&nbsp;<h4>".$this->faker->sentence."</h4>"
            ."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p>"
            ."&nbsp;<h4>".$this->faker->sentence."</h4>"
            ."<p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p>"
            ."&nbsp;<h4>".$this->faker->sentence."</h4>"
            ."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p>"
            ."&nbsp;<h4>".$this->faker->sentence."</h4>"
            ."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p><p>".$this->faker->paragraph(10)."</p>",
            'content_number' => 1,
        ];
    }
}