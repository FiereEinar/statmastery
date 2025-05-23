<div class="transition-all rounded-md bg-base-100 w-80 shadow-sm border border-neutral-content relative overflow-hidden hover:shadow-lg cursor-pointer">
    <span class="absolute top-2 left-2 badge badge-{{ $course->badge->name === 'Beginner' ? 'success' : ($course->badge->name === 'Intermediate' ? 'warning' : 'error') }} z-60">{{ $course->badge->name }}</span>
    <figure>
        <x-course-image source="{{ $course->thumbnail }}" />
    </figure>
    <div class="border-t border-blue-800">
        <div class="p-5 space-y-1">
            <h2 class="font-semibold">{{ $course['title'] }}</h2>
            <p class="text-base-content/70 line-clamp-2">{{ $course['description'] }}</p>
        </div>
        <div class="flex justify-between items-center p-5 border-t border-primary">
            <p class="text-base-content/70">{{ $course->price <= 0 ? 'Free' : 'Paid' }}</p>
            <a href="/course/{{ $course['id'] }}" class="flex items-center gap-1 text-primary cursor-pointer">
                <button class="hover:underline underline-primary cursor-pointer">{{ $actionTitle }}</button>
                <x-icon name="chevron-right" />
            </a>
        </div>
    </div>
</div>