<?php
use function _\startCase;
?>
<div class="flex gap-10">
    <aside class="shrink-0 space-y-8 w-[300px]">
        <div class="space-y-1">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="/"><x-icon class="size-5" name="home" />Home</a></li>
                    <li><a wire:click="resetActiveCategory()"><x-icon class="size-5" name="book-open" />Courses</a></li>
                    @if ($activeCategory)
                        <li><a>{{ startCase($activeCategory['name']) }}</a></li>
                    @endif
                </ul>
            </div>
            <h1 class="text-3xl">Learning Catalog</h1>
        </div>
        <div class="space-y-2">
            <h4 class="text-2xl text-base-content/50">Categories</h4>
            <div class="w-full h-1 border-b-2 border-neutral-content"></div>
            <div class="space-y-1">
                @foreach ($categories as $category)
                <button wire:click="setActiveCategory({{ $category }})" class="transition-all cursor-pointer py-2 px-4 rounded hover:bg-primary/10 truncate w-full text-start {{ $activeCategory && $activeCategory['id'] === $category['id'] ? 'bg-primary/10' : '' }}">
                    <p>{{ startCase($category->name) }}</p>
                </button>
                @endforeach
            </div>
        </div>
    </aside>
    <div class="grow space-y-4">
        @if ($activeCategory)
        <div>
            <h4 class="text-2xl">{{ startCase($activeCategory['name']) }}</h4>
            <p class="text-base-content/50">{{ $activeCategory['description'] }}</p>
        </div>
        @else
        <h4 class="text-2xl">Explore courses</h4>
        @endif
        <div class="flex gap-4 flex-wrap">
            @if ($activeCategory)
                @if($activeCategory->courses->isEmpty())
                <p class="text-base-content/50 italic">No courses yet.</p>
                @endif
                @foreach ($activeCategory->courses as $course)
                <x-course-card :course="$course" />
                @endforeach            
            @else
                @if($courses->isEmpty())
                <p class="text-base-content/50 italic">No courses yet.</p>
                @endif
                @foreach ($courses as $course)
                <x-course-card :course="$course" />
                @endforeach
            @endif
        </div>
    </div>
</div>