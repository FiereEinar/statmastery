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
      <h1 class="text-3xl">Add Course</h1>
      <form action="/v1/api/course" method="POST">
        @csrf
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Title</legend>
          <input name="title" type="text" class="input" placeholder="Type here" />
        </fieldset>

        <fieldset class="fieldset">
          <legend class="fieldset-legend">Description</legend>
          <textarea name="description" class="textarea h-24" placeholder="Type here"></textarea>
        </fieldset>

        <fieldset class="fieldset">
          <legend class="fieldset-legend">Path</legend>
          <input name="thumbnail" type="text" class="input" placeholder="images/test.png" />
        </fieldset>

        <fieldset class="fieldset">
          <legend class="fieldset-legend">Overview</legend>
          <textarea name="overview" class="textarea h-24" placeholder="Type here"></textarea>
        </fieldset>

        <div class="flex gap-2">
          <fieldset class="fieldset">
            <legend class="fieldset-legend">Time to complete</legend>
            <input name="time_to_complete" type="text" class="input validator" required placeholder="Enter here" />
          </fieldset>
          
          <fieldset class="fieldset">
            <legend class="fieldset-legend">Price (P)</legend>
            <input value="0" name="price" type="number" class="input validator" required placeholder="Enter here" />
          </fieldset>
        </div>

        <div class="flex gap-2">
          <fieldset class="fieldset">
            <legend class="fieldset-legend">Difficulty</legend>
            <select name="badge" class="select">
              <option selected>Beginner</option>
              <option>Intermediate</option>
              <option>Advanced</option>
            </select>
          </fieldset>
        </div>

        <div class="mt-3">
          <x-button type="submit" primary label="Add Course" />
        </div>
      </form>
		</x-custom-section>
    <x-footer />
	</body>
</html>
