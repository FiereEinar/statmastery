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
		<x-custom-section>
      <div class="flex justify-between gap-10">
        <div class="space-y-5 max-w-[700px]">
          <h1 class="text-3xl">{{ $course->title }}</h1>
          <p>{{ $course->description }}</p>
          <div class="gap-2 flex">
            @if ($hasPayed || $course->subscription_type === 'Free' || $course->price <= 0)
              <x-button href="/course/{{ $course->id }}/content" primary label="Go to Course" />
            @else
              <form target="_blank" action="/v1/api/course/{{ $course->id }}/checkout" method="POST">
                @csrf
                <x-button type="submit" primary label="Enroll Now" />
              </form>
            @endif
            @if (auth()->guard('web')->user()->id === $course->owner_id)
              <x-button href="/course/{{ $course->id }}/edit" primary outline label="Edit Course" />
            @endif
          </div>
          <div class="w-full h-1 border-b-2 border-neutral-content"></div>
          <div class="space-y-3">
            <h2 class="text-xl">Overview</h2>
            <p>{{ $course->overview }}</p>
          </div>
          <div class="w-full h-1 border-b-2 border-neutral-content"></div>
          <div class="space-y-3">
            <h2 class="text-xl">Curriculum</h2>
            <div class="overflow-y-auto h-full">
              @if ($course->modules->isEmpty())
              <div class="flex items-center gap-2 px-5 py-3">
                  <h1 class="italic text-base-content/50">No modules yet</h1>
              </div>
              @endif
              @foreach ($course->modules as $module)
              <div class="collapse collapse-arrow bg-base-100 border border-base-300">
                <input type="radio" name="my-accordion-2" />
                <div class="collapse-title font-semibold flex items-center gap-3">
                    <div class="rounded-full size-6 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-4" /></div>
                    <p class="truncate">{{ $module->title }}</p>
                </div>
                <div class="collapse-content text-sm pl-10">
                    @if ($module->contents->isEmpty())
                    <div class="flex items-center gap-2 p-2">
                        <h1 class="italic text-base-content/50">No contents yet</h1>
                    </div>
                    @endif
                    @foreach ($module->contents as $content)
                    <button 
                    class="transition-all w-full flex items-center gap-1 p-3 cursor-pointer hover:bg-neutral-content"
                    >
                        <div class="rounded-full size-4 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-2" /></div>
                        <p class="truncate">{{ $content->title }}</p>
                    </button>
                    @endforeach
                </div>
              </div>
              @endforeach
              {{-- <button onclick="tinymce.activeEditor.options.set('disabled', false)">click</button> --}}
            </div>
          </div>
        </div>
        <div class="space-y-5">
          <div class="max-w-[600px]">
            <x-course-image source="{{ $course->thumbnail }}" />
          </div>
          <div class="flex justify-center gap-10">
            <div class="flex flex-col items-center gap-1">
              <x-icon name="lock-closed" class="size-8" />
              <h2 class="text-xl">{{ $course->subsription_type ?? "Free" }}</h2>
            </div>
            <div class="flex flex-col items-center gap-1">
              <x-icon name="currency-dollar" class="size-8" />
              <h2 class="text-xl">P{{ $course->price ?? 0 }}</h2>
            </div>
            <div class="flex flex-col items-center gap-1">
              <x-icon name="chart-bar" class="size-8" />
              <h2 class="text-xl">{{ $course->badge }}</h2>
            </div>
            <div class="flex flex-col items-center gap-1">
              <x-icon name="clock" class="size-8" />
              <h2 class="text-xl">{{ $course->time_to_complete }}</h2>
            </div>
          </div>
          <div>
            <h2 class="text-xl">Achievements</h2>
            <p>What you&apos;ll earn from this course.</p>
          </div>
          <div>
            <h2 class="text-xl">Reviews</h2>
          </div>
        </div>
      </div>
		</x-custom-section>
	</body>
</html>
