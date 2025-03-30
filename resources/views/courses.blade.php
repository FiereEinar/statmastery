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
    <section class="text-base-content/70 min-h-[100dvh] px-20 py-10 space-y-8">
      <div class="flex justify-between items-center">
        <h1 class="text-3xl">Courses</h1>
        <x-button primary label="Add Course" href="/course/create" />    
      </div>
      <div>
        <p>Courses: {{ sizeof($courses) }}</p>
      </div>
      <div class="flex gap-4 flex-wrap">
        @foreach ($courses as $course)
          <x-course-card :course="$course" badgeColor="success" />
        @endforeach
      </div>
    </section>
    <x-footer />
	</body>
</html>
