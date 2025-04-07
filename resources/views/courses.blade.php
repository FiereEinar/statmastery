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
      <div class="flex justify-between items-center">
        <h1 class="text-3xl">Courses</h1>
        <x-button icon="plus" primary label="Add Course" href="/course/create" />    
      </div>
      <div class="flex gap-4 flex-wrap">
        @foreach ($courses as $course)
          <x-course-card :course="$course" badgeColor="success" />
        @endforeach
      </div>
		</x-custom-section>
			<x-footer />
	</body>
</html>
