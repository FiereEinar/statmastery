@php
    $courseList = [
        [
            "title" => "Statistics & Probability",
            "description" => "Master data analysis, probability, and statistical inference. Learn how to interpret real-world data and make informed decisions with confidence.",
            "image" => "images/courses/statistics-card-img.jpg",
            "badge" => "Advanced",
            "badgeColor" => "badge-error"
        ],
        [
            "title" => "Mathemathics In The Modern World",
            "description" => "Explore the beauty of mathematics in everyday life! From logic and patterns to financial math and coding, see how math shapes the world around us.",
            "image" => "images/courses/mtmw.png",
            "badge" => "Beginner",
            "badgeColor" => "badge-success"
        ],
        [
            "title" => "Discrete Math",
            "description" => "Dive into logic, set theory, graph theory, and combinatorics. Perfect for students in computer science, cryptography, and mathematical reasoning.",
            "image" => "images/courses/discrete-math.jpg",
            "badge" => "Intermediate",
            "badgeColor" => "badge-warning"
        ],
        [
            "title" => "Quantitative Methods",
            "description" => "Develop problem-solving skills using mathematical models and statistical tools. Ideal for business, economics, and research applications.",
            "image" => "images/courses/quantitative-methods.jpg",
            "badge" => "Intermediate",
            "badgeColor" => "badge-warning"
        ],
    ];
@endphp

<div class="flex gap-4 flex-wrap">
    @for ($i = 0; $i < $courses; $i++)
        <div class="card bg-base-100 w-64 shadow-xl relative overflow-hidden">
            <span class="absolute top-2 left-2 badge {{  $courseList[$i]['badgeColor']}} z-60">{{ $courseList[$i]['badge'] }}</span>
            <figure>
                <img src="{{ asset($courseList[$i]['image']) }}" alt="Course image" />
            </figure>
            <div class="card-body border-t border-blue-800">
                <h2 class="card-title">{{ $courseList[$i]['title'] }}</h2>
                <p>{{ $courseList[$i]['description'] }}</p>
                <div class="card-actions justify-end">
                    <x-button primary label="View Course" />
                </div>
            </div>
        </div>
    @endfor
</div>
