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

		@php
			$totalStudentCount = 0;

			foreach ($courses as $course) {
				$totalStudentCount += $course->students->count();
			}
		@endphp

		<x-welcome-admin-section :user="$user" :totalStudentCount="$totalStudentCount" />

		<section class="px-28 py-10 space-y-6">
			<div class="flex justify-between items-center">
				<h1 class="text-2xl">My Courses ({{ $courses->count() }})</h1>
				<x-button href="/course/create" icon="plus" flat primary label="Create Course" />
			</div>
			<div class="space-y-4">
				@foreach ($courses as $course)
					<x-course-article :course="$course" />
				@endforeach
			</div>
		</section>

    <x-footer />
	</body>
</html>
