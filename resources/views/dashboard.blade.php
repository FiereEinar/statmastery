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
    @auth
		<div class="text-base-content/70 flex h-full">
			<section class="grow w-full pl-20 pr-4 py-10 space-y-8">
				<div class="flex justify-between">
					<div class="flex items-center gap-2">
						<x-icon name="book-open" class="size-8" />
						<h1 class="text-3xl">My Learning</h1>
					</div>
				</div>
				<div class="space-y-2">
					<h4 class="font-semibold text-lg">In-Progress</h4>
					<div class="flex gap-4 flex-wrap">
						@foreach ($takenCourses as $course)
							<x-course-card :course="$course" actionTitle="Continue" />
						@endforeach
					</div>
				</div>
				<div class="space-y-2">
					<h4 class="font-semibold text-lg">Completed</h4>
					<x-coursesplaceholder courses="1" />
				</div>
			</section>
			<aside class="grow-0 bg-neutral-content/50 min-h-full px-8 py-10 w-[500px] space-y-4">
				<div class="flex justify-between items-center">
					<h4 class="font-semibold text-lg">Latest Acheivements</h4>
					<a href="#" class="text-xs text-primary hover:underline">Show all</a>
				</div>
				<div class="w-full h-28 border-2 border-neutral-content"></div>
				<div class="w-full h-1 border-b-2 border-neutral-content"></div>
				<h4 class="font-semibold text-lg">Continue Learning</h4>
				<div>

				</div>
			</aside>
		</div>
		@else
    <section class="w-full h-[100dvh] flex flex-col gap-3 justify-center items-center">
      <h1>You are not logged in.</h1>
      <a href="/login">
        <x-button primary label="Login" />
      </a>
    </section>
    @endauth
    <x-footer />
	</body>
</html>
