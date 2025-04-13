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
			<livewire:course-explorer :courses="$courses" :categories="$categories" >
		</x-custom-section>
		<x-footer />
	</body>
</html>
