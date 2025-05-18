<a href="/user/progress/course/{{ $course->id }}">
    <div class="transition-all p-4 flex gap-4 border border-white hover:border-neutral-content rounded-2xl hover:shadow-md">
        <x-course-image source="{{ $course->thumbnail }}" className="!w-[350px]" />

        <div class="flex flex-col gap-2 justify-center">
            <span class="badge badge-{{ $course->badge->name === 'Beginner' ? 'success' : ($course->badge->name === 'Intermediate' ? 'warning' : 'error') }} z-60">{{ $course->badge->name }}</span>
            <h2 class="text-xl">
                {{ $course->title }}
                <p class="text-base-content/70 text-xs">Created at: {{ $course->created_at }}</p>
            </h2>
            <p class="text-base-content/70 line-clamp-2">{{ $course->description }}</p>
            <p class="text-base-content/70">{{ $course->price <= 0 ? 'Free' : 'Paid' }}</p>
        </div>

        <div class="flex flex-col gap-2 items-center justify-center">
            <h2 class="text-3xl">{{ $course->students->count() }}</h2>
            <p class="text-base-content/70">Students</p>
        </div>

        <div class="flex flex-col gap-2 items-center justify-center px-6">
            <x-icon name="chevron-right" />
        </div>
    </div>
</a>