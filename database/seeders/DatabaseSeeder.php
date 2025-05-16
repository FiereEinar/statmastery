<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseBadge;
use App\Models\CourseCategory;
use App\Models\CourseComment;
use App\Models\CourseModule;
use App\Models\CourseModuleContent;
use App\Models\CourseModuleContentType;
use App\Models\CourseReview;
use App\Models\Enrollment;
use App\Models\ProgressTracking;
use App\Models\Quiz;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $module_count = 1;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Nick Mours',
            'email' => 'nick@gmail.com',
            'password' => '123123',
        ]);
        User::factory()->count(5)->create();

        CourseBadge::factory()->create([
            'name'=> 'Beginner',
        ]);
        CourseBadge::factory()->create([
            'name'=> 'Intermediate',
        ]);
        CourseBadge::factory()->create([
            'name'=> 'Advanced',
        ]);

        CourseCategory::factory()->create([
            "name" => "Advanced",
        ]);
        CourseCategory::factory()->create([
            "name" => "Fundamentals",
        ]);
        CourseCategory::factory()->create([
            "name" => "Analysis",
        ]);
        CourseCategory::factory()->create([
            "name" => "Geometry",
        ]);
        CourseCategory::factory()->create([
            "name" => "Probability",
        ]);

        Course::factory()->create([
            "title" => "Statistics & Probability",
            "description" => "Master data analysis, probability, and statistical inference. Learn how to interpret real-world data and make informed decisions with confidence.",
            "thumbnail" => "thumbnails/statistics-card-img.jpg",
            "time_to_complete" => "1 Month",
            "price" => 500,
        ]);

        Course::factory()->create([
            "title" => "Mathemathics In The Modern World",
            "description" => "Explore the beauty of mathematics in everyday life! From logic and patterns to financial math and coding, see how math shapes the world around us.",
            "thumbnail" => "thumbnails/mtmw.png",
            "time_to_complete" => "3 Months",
            "price" => 0,
        ]);

        Course::factory()->create([
            "title" => "Discrete Math",
            "description" => "Dive into logic, set theory, graph theory, and combinatorics. Perfect for students in computer science, cryptography, and mathematical reasoning.",
            "thumbnail" => "thumbnails/discrete-math.jpg",
            "time_to_complete" => "5 Months",
            "price" => 1100,
        ]);

        Course::factory()->create([
            "title" => "Quantitative Methods",
            "description" => "Develop problem-solving skills using mathematical models and statistical tools. Ideal for business, economics, and research applications.",
            "thumbnail" => "thumbnails/quantitative-methods.jpg",
            "time_to_complete" => "2 Months",
            "price" => 0,
        ]);

        Course::factory()->create([
            "title" => "Fundamentals of Algebra",
            "description" => "Build a strong foundation in algebra with topics like variables, expressions, equations, and real-life applications. Perfect for high school and college beginners.",
            "thumbnail" => "nothing.jpg",
            "time_to_complete" => "3 Weeks",
            "price" => 0,
        ]);

        Course::factory()->create([
            "title" => "Calculus Essentials",
            "description" => "Understand the core concepts of limits, derivatives, and integrals. A must-have course for STEM students aiming to master continuous change.",
            "thumbnail" => "nothing.jpg",
            "time_to_complete" => "8 Months",
            "price" => 1400,
        ]);

        Course::factory()->create([
            "title" => "Linear Algebra",
            "description" => "Master the art of matrix operations, vector spaces, and linear equations. Perfect for math enthusiasts and computer science beginners.",
            "thumbnail" => "nothing.jpg",
            "time_to_complete" => "4 Months",
            "price" => 600,
        ]);

        Course::factory()->create([
            "title" => "Geometry Essentials",
            "description" => "Learn the basics of geometry, including points, lines, planes, and angles. Perfect for students in math, physics, and engineering.",
            "thumbnail" => "nothing.jpg",
            "time_to_complete" => "2 Months",
            "price" => 500,
        ]);


        Course::factory()->create([
            "title" => "Calculus Essentials",
            "description" => "Understand the core concepts of limits, derivatives, and integrals. A must-have course for STEM students aiming to master continuous change.",
            "thumbnail" => "nothing.jpg",
            "time_to_complete" => "8 Months",
            "price" => 1400,
        ]);

        CourseModuleContentType::factory()->create([
            "name" => "content",
        ]);
        CourseModuleContentType::factory()->create([
            "name" => "quiz",
        ]);

        $this->createCourseModules(1, 9);
        $this->createCourseModules(2, 8);
        $this->createCourseModules(3, 3);
        $this->createCourseModules(4, 6,);
        $this->createCourseModules(5, 10);
        $this->createCourseModules(6, 5);

        CourseComment::factory(20)->create();
        CourseReview::factory(20)->create();

        Enrollment::create(["user_id" => 1, "course_id" => 1]);
        Enrollment::create(["user_id" => 1, "course_id" => 4]);
        Enrollment::create(["user_id" => 1, "course_id" => 3]);

        Enrollment::create(["user_id" => 2, "course_id" => 4]);
        Enrollment::create(["user_id" => 2, "course_id" => 1]);

        Enrollment::create(["user_id" => 3, "course_id" => 1]);

        for ($i = 1; $i <= 3; $i++) {
            ProgressTracking::create([
                'user_id' => 1,
                'course_id' => 1,
                'module_id' => 1,
                'content_id' => $i,
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            ProgressTracking::create([
                'user_id' => 1,
                'course_id' => 3,
                'module_id' => 1,
                'content_id' => $i,
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            ProgressTracking::create([
                'user_id' => 2,
                'course_id' => 1,
                'module_id' => 1,
                'content_id' => $i,
            ]);
        }

        
    }

    private function createCourseModules($courseID, $moduleCount = 5) {
        for ($i = 1; $i <= $moduleCount; $i++) {
            CourseModule::factory()->create([
                "course_id" => $courseID,
                "module_number" => $i,
            ]);

            $contentCount = rand(3, 8);
    
            for ($j = 1; $j <= $contentCount; $j++) {
                CourseModuleContent::factory()->create([
                    "course_module_id" => $this->module_count,
                    "content_number"=> $j,
                ]);
            }

            // quiz content at the end of the module
            $quizContent = CourseModuleContent::factory()->create([
                "course_module_id" => $this->module_count,
                "content_number"=> $j + 1,
                "content_type_id" => 2,
            ]);

            $quizAmount = 10;

            for ($k = 1; $k <= $quizAmount; $k++) {
                Quiz::factory()->create([
                    "course_module_content_id" => $quizContent->id,
                ]);
            }
            
            $this->module_count++;
        }
    }
}