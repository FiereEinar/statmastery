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

		<section class="flex justify-between px-28 py-10 bg-[url('../../public/images/profile-cover.png')] bg-cover bg-center">
        <div class="flex gap-4">
            <div class="relative">
                <x-custom-image 
                :source="'storage/' . ($user->profile_picture ?? 'nothing.png')" 
                defaultImg="images/user-placeholder.jpg"
                className="rounded-full size-24"
                :alt="auth()->user()->name . ' profile picture'" 
                />
            </div>
            <div class="flex flex-col justify-center text-neutral-content">
                <p>Welcome, Admin!</p>
                <h1 class="text-3xl">{{ $user->name }}</h1>
                <p class="text-xs text-neutral-content/50">Keep track of your learner's progress</p>
            </div>
        </div>
        <div>
					<div class="flex flex-col gap-2 items-center justify-center text-white">
            <h2 class="text-3xl flex items-center gap-2">
							<x-icon name="users" />
							{{ $totalStudentCount }}
						</h2>
            <p>Total Students</p>
        	</div>
        </div>
    </section>

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
