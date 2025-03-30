<div class="card bg-base-100 w-64 shadow-xl relative overflow-hidden">
    <span class="absolute top-2 left-2 badge badge-{{ $badgeColor }} z-60">{{ $course['badge'] }}</span>
    <figure>
        <img src="{{ asset($course['thumbnail']) }}" alt="Course image" />
    </figure>
    <div class="card-body border-t border-blue-800">
        <h2 class="card-title">{{ $course['title'] }}</h2>
        <p>{{ $course['description'] }}</p>
        <div class="card-actions justify-end">
            <x-button primary label="View Course" />
        </div>
    </div>
</div>