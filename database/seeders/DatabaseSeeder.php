<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Nick Mours',
            'email' => 'nick@gmail.com',
            'password' => '123123',
        ]);

        Course::factory()->create([
            "title" => "Statistics & Probability",
            "description" => "Master data analysis, probability, and statistical inference. Learn how to interpret real-world data and make informed decisions with confidence.",
            "thumbnail" => "images/courses/statistics-card-img.jpg",
            "time_to_complete" => "1 Month",
            "price" => 500,
            "badge" => "Advanced",
        ]);

        Course::factory()->create([
            "title" => "Mathemathics In The Modern World",
            "description" => "Explore the beauty of mathematics in everyday life! From logic and patterns to financial math and coding, see how math shapes the world around us.",
            "thumbnail" => "images/courses/mtmw.png",
            "badge" => "Beginner",
            "time_to_complete" => "3 Months",
            "price" => 0,
        ]);

        Course::factory()->create([
            "title" => "Discrete Math",
            "description" => "Dive into logic, set theory, graph theory, and combinatorics. Perfect for students in computer science, cryptography, and mathematical reasoning.",
            "thumbnail" => "images/courses/discrete-math.jpg",
            "badge" => "Intermediate",
            "time_to_complete" => "5 Months",
            "price" => 1100,
        ]);

        Course::factory()->create([
            "title" => "Quantitative Methods",
            "description" => "Develop problem-solving skills using mathematical models and statistical tools. Ideal for business, economics, and research applications.",
            "thumbnail" => "images/courses/quantitative-methods.jpg",
            "badge" => "Intermediate",
            "time_to_complete" => "2 Months",
            "price" => 0,
        ]);

        Course::factory()->create([
            "title" => "Fundamentals of Algebra",
            "description" => "Build a strong foundation in algebra with topics like variables, expressions, equations, and real-life applications. Perfect for high school and college beginners.",
            "thumbnail" => "images/courses/algebra.jpg",
            "badge" => "Beginner",
            "time_to_complete" => "3 Weeks",
            "price" => 0,
        ]);

        Course::factory()->create([
            "title" => "Calculus Essentials",
            "description" => "Understand the core concepts of limits, derivatives, and integrals. A must-have course for STEM students aiming to master continuous change.",
            "thumbnail" => "images/courses/calculus.jpg",
            "badge" => "Advanced",
            "time_to_complete" => "8 Months",
            "price" => 1400,
        ]);
    }
}