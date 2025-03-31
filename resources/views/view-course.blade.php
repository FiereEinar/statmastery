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
		<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
		<livewire:scripts />
	</head>
	<body>
    <x-topbar />
		<x-custom-section>
      <div class="flex justify-between gap-10">
        <div class="space-y-5 max-w-[700px]">
          <h1 class="text-3xl">{{ $course->title }}</h1>
          <p>{{ $course->description }}</p>
          <div>
            <x-button href="/course/{{ $course->id }}/enroll" primary label="Enroll Now" />
          </div>
          <div>
            <h2 class="text-xl">Overview</h2>
            <p>{{ $course->overview }}</p>
          </div>
          <div>
            <h2 class="text-xl">Curriculum</h2>
          </div>
        </div>
        <div class="space-y-5">
          <div class="max-w-[600px]">
            <x-course-image source="{{ $course->thumbnail }}" />
          </div>
          <div class="flex justify-center gap-10">
            <div class="flex flex-col items-center gap-1">
              <x-icon name="lock-closed" class="size-10" />
              <h2 class="text-xl">{{ $course->subsription_type ?? "Free" }}</h2>
            </div>
            <div class="flex flex-col items-center gap-1">
              <x-icon name="currency-dollar" class="size-10" />
              <h2 class="text-xl">P{{ $course->price ?? 0 }}</h2>
            </div>
            <div class="flex flex-col items-center gap-1">
              <x-icon name="chart-bar" class="size-10" />
              <h2 class="text-xl">{{ $course->badge }}</h2>
            </div>
            <div class="flex flex-col items-center gap-1">
              <x-icon name="clock" class="size-10" />
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
    <x-footer />
	</body>
</html>
