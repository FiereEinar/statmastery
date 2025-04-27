<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Laravel</title>

		<!-- Fonts -->
		<link rel="preconnect" href="https://fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

		<!-- Styles / Scripts -->
		@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
			@vite(['resources/css/app.css', 'resources/js/app.js'])
		@else
			<style>
			</style>
		@endif
		<livewire:styles />
		<wireui:scripts />
		<livewire:scripts />
	</head>
	<body>
    <x-topbar />
		<section>
      <div class="flex w-full">
        <div class="space-y-5 border-r border-neutral-content">
          {{-- Course Hero Section --}}
          <div class="relative py-8 pr-5 pl-32 bg-neutral-content/50 border-b-2 border-neutral-content space-y-5">
            <div class="breadcrumbs text-sm">
              <ul>
                <li><a href="/"><x-icon class="size-5" name="home" />Home</a></li>
                <li><a href="/course"><x-icon class="size-5" name="book-open" />Courses</a></li>
                <li><a>{{ $course->title }}</a></li>
              </ul>
            </div>
            <h1 class="text-3xl">{{ $course->title }}</h1>
            <p>{!! nl2br(e($course->description)) !!}</p>
            <div class="flex gap-2">
              @if ($hasPayed || $course->subscription_type === 'Free' || $course->price <= 0)
                <x-button href="/course/{{ $course->id }}/content" primary label="{{sizeof($userProgress) === 0 ? 'Get Started' : 'Continue'}} With The Course" />
              @else
                <form target="_blank" action="/v1/api/course/{{ $course->id }}/checkout" method="POST">
                  @csrf
                  <x-button type="submit" primary label="Enroll Now" />
                </form>
              @endif
              @if (auth()->guard('web')->check() && auth()->guard('web')->user()->id === $course->owner_id)
                <x-button href="/course/{{ $course->id }}/edit" primary outline label="Edit Course" />
              @endif
            </div>
          </div>

          {{-- Course Overview --}}
          <div class="py-8 pr-5 pl-32 space-y-5">
            {{-- Overview --}}
            <div class="space-y-3">
              <h2 class="text-xl">Overview</h2>
              <p>{!! nl2br(e($course->overview)) !!}</p>
            </div>

            <div class="w-full h-1 border-b-2 border-neutral-content"></div>

            {{-- Curriculum --}}
            <div class="space-y-3">
              <div class="flex justify-between">
                <h2 class="text-xl">Curriculum</h2>
                <p class="text-base-content/50">{{ $course->modules->count() }} Modules</p>
              </div>
              <div class="overflow-y-auto max-h-[400px]">
                @if ($course->modules->isEmpty())
                <div class="flex items-center gap-2 px-5 py-3">
                  <h1 class="italic text-base-content/50">No modules yet</h1>
                </div>
                @endif
                @foreach ($course->modules as $module)
                @php
                  $contentIds = $module->contents->pluck('id')->toArray();
                  $unfinished = array_diff($contentIds, $userProgress);
                  $isCompleted = count($unfinished) === 0 && count($contentIds) > 0;
                @endphp
                <div class="collapse collapse-arrow bg-base-100 border border-base-300">
                  <input type="checkbox" name="my-accordion-2" />
                  <div class="collapse-title font-semibold flex items-center gap-3">
                    <div class="rounded-full size-6 shrink-0 border border-primary flex items-center justify-center {{ $isCompleted ? 'bg-primary' : '' }}"><x-icon name="check" class="text-white size-4" /></div>
                    <p class="truncate">{{ $module->title }}</p>
                  </div>
                  <div class="collapse-content text-sm pl-10">
                      @if ($module->contents->isEmpty())
                      <div class="flex items-center gap-2 p-2">
                        <h1 class="italic text-base-content/50">No contents yet</h1>
                      </div>
                      @endif
                      @foreach ($module->contents as $content)
                      <button class="transition-all w-full flex items-center gap-1 p-3 cursor-pointer hover:bg-neutral-content">
                        <div 
                        class="rounded-full size-4 shrink-0 border border-primary flex items-center justify-center
                        {{ in_array($content->id, $userProgress) ? 'bg-primary' : '' }} 
                        ">
                          <x-icon name="check" class="text-white size-2" />
                        </div>
                        <p class="truncate">{{ $content->title }}</p>
                      </button>
                      @endforeach
                  </div>
                </div>
                @endforeach
              </div>
            </div>

            <div class="w-full h-1 border-b-2 border-neutral-content"></div>
  
            {{-- Course Comments --}}
            <div class="mb-20">
              <livewire:course-comment-section :course="$course" :currentUser="auth()->guard('web')->user()" />
            </div>
          </div>
        </div>

        {{-- Course Right-Side Section --}}
        <div class="space-y-5 bg-neutral-content/50">
          {{-- Course Image --}}
          <div class="w-[500px]">
            <x-custom-image 
            source="{{ $course->thumbnail }}" 
            defaultImg="images/courses/placeholder.png"
            alt="Course image"
            className="w-full object-cover object-center"
            />
          </div>

          {{-- Course Details --}}
          <div class="flex justify-center gap-10 px-8">
            <div class="flex flex-col items-center gap-1">
              <x-icon name="lock-closed" class="size-6" />
              <h2 class="tex">{{ $course->price <= 0 ? "Free" : "Paid" }}</h2>
            </div>
            <div class="flex flex-col items-center gap-1">
              <x-icon name="currency-dollar" class="size-6" />
              <h2 class="tex">P{{ $course->price ?? 0 }}</h2>
            </div>
            <div class="flex flex-col items-center gap-1">
              <x-icon name="chart-bar" class="size-6" />
              <h2 class="tex">{{ $course->badge->name }}</h2>
            </div>
            <div class="flex flex-col items-center gap-1">
              <x-icon name="clock" class="size-6" />
              <h2 class="tex">{{ $course->time_to_complete }}</h2>
            </div>
          </div>

          <div class="w-full h-1 border-b-2 border-neutral-content"></div>

          {{-- Course Achievements --}}
          <div class="px-8">
            <h2 class="text-xl">Achievements</h2>
            <p>What you&apos;ll earn from this course.</p>
          </div>

          <div class="w-full h-1 border-b-2 border-neutral-content"></div>
          
          {{-- Course Reviews --}}
          <div class="px-8">
            <h2 class="text-xl">Reviews</h2>
          </div>
        </div>
      </div>
		</section>
	</body>
</html>
