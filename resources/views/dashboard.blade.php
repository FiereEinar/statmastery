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
    @auth
		<x-custom-section>
			<div class="flex justify-between">
				<div class="flex items-center gap-2">
					<x-icon name="book-open" class="size-10" />
					<h1 class="text-3xl">My Learning</h1>
				</div>
			</div>
      <div>
        <h4 class="font-semibold text-lg">In-Progress</h4>
        <x-coursesplaceholder courses="3" />
      </div>
      <div>
        <h4 class="font-semibold text-lg">Completed</h4>
        <x-coursesplaceholder courses="2" />
      </div>
		</x-custom-section>
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
