@php
    $courseList = [
        [
            "title" => "Statistics & Probability",
            "description" => "Master data analysis, probability, and statistical inference. Learn how to interpret real-world data and make informed decisions with confidence.",
            "image" => "images/courses/statistics-card-img.jpg",
            "badge" => "Advanced",
            "badgeColor" => "badge-error",
            "subscription_type" => "Paid"
        ],
        [
            "title" => "Mathemathics In The Modern World",
            "description" => "Explore the beauty of mathematics in everyday life! From logic and patterns to financial math and coding, see how math shapes the world around us.",
            "image" => "images/courses/mtmw.png",
            "badge" => "Beginner",
            "badgeColor" => "badge-success",
            "subscription_type" => "Free"
        ],
        [
            "title" => "Discrete Math",
            "description" => "Dive into logic, set theory, graph theory, and combinatorics. Perfect for students in computer science, cryptography, and mathematical reasoning.",
            "image" => "images/courses/discrete-math.jpg",
            "badge" => "Intermediate",
            "badgeColor" => "badge-warning",
            "subscription_type" => "Paid"
        ],
        [
            "title" => "Quantitative Methods",
            "description" => "Develop problem-solving skills using mathematical models and statistical tools. Ideal for business, economics, and research applications.",
            "image" => "images/courses/quantitative-methods.jpg",
            "badge" => "Intermediate",
            "badgeColor" => "badge-warning",
            "subscription_type" => "Free"
        ],
        [
            "title" => "Fundamentals of Algebra",
            "description" => "Build a strong foundation in algebra with topics like variables, expressions, equations, and real-life applications. Perfect for high school and college beginners.",
            "image" => "images/courses/algebra.jpg",
            "badge" => "Beginner",
            "badgeColor" => "badge-success",
            "subscription_type" => "Free"
        ],
        [
            "title" => "Calculus Essentials",
            "description" => "Understand the core concepts of limits, derivatives, and integrals. A must-have course for STEM students aiming to master continuous change.",
            "image" => "images/courses/calculus.jpg",
            "badge" => "Advanced",
            "badgeColor" => "badge-error",
            "subscription_type" => "Paid"
        ],
    ];
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 w-fit">
    @for ($i = 0; $i < $courses; $i++)
    <div class="rounded-xl bg-base-100 w-80 shadow-xl relative overflow-hidden">
        <span class="absolute top-2 left-2 badge badge-{{ $courseList[$i]['badge'] === 'Beginner' ? 'success' : ($courseList[$i]['badge'] === 'Intermediate' ? 'warning' : 'error') }} z-60">{{ $courseList[$i]['badge'] }}</span>
        <figure>
            <x-course-image source="{{ $courseList[$i]['image'] }}" />
        </figure>
        <div class="border-t border-blue-800">
            <div class="p-5">
                <h2 class="font-semibold">{{ $courseList[$i]['title'] }}</h2>
                <p class="text-base-content/70 truncate">{{ $courseList[$i]['description'] }}</p>
            </div>
            <div class="flex justify-between items-center p-5 border-t border-primary">
                <p class="text-base-content/70">{{ $courseList[$i]['subscription_type'] }}</p>
                <a class="flex items-center gap-1 text-primary cursor-pointer">
                    <button class="hover:underline underline-primary cursor-pointer">Get Started</button>
                    <x-icon name="chevron-right" />
                </a>
            </div>
        </div>
    </div>
    @endfor
</div>
