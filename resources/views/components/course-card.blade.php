<div class="rounded-xl bg-base-100 w-80 shadow-xl relative overflow-hidden">
    <span class="absolute top-2 left-2 badge badge-{{ $course['badge'] === 'Beginner' ? 'success' : ($course['badge'] === 'Intermediate' ? 'warning' : 'error') }} z-60">{{ $course['badge'] }}</span>
    <figure>
        <x-course-image source="{{ $course->thumbnail }}" />
    </figure>
    <div class="border-t border-blue-800">
        <div class="p-5">
            <h2 class="font-semibold">{{ $course['title'] }}</h2>
            <p class="text-base-content/70 truncate">{{ $course['description'] }}</p>
        </div>
        <div class="flex justify-between items-center p-5 border-t border-primary">
            <p class="text-base-content/70">{{ $course->subscription_type }}</p>
            <a href="/course/{{ $course['id'] }}" class="flex items-center gap-1 text-primary cursor-pointer">
                <button class="hover:underline underline-primary cursor-pointer">Get Started</button>
                <x-icon name="chevron-right" />
            </a>
        </div>
    </div>
</div>