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
      <h1 class="text-3xl">Courses</h1>
      <div>
        <p>Courses: {{ sizeof($courses) }}</p>
      </div>
      <div class="flex gap-4 flex-wrap">
        @foreach ($courses as $course)
          <x-course-card :course="$course" badgeColor="success" />
        @endforeach
      </div>

      <div>
        <h1>Add Course</h1>
        <form action="/v1/api/course" method="POST">
          @csrf
          <fieldset class="fieldset">
            <legend class="fieldset-legend">Title</legend>
            <input name="title" type="text" class="input" placeholder="Type here" />
          </fieldset>
          <fieldset class="fieldset">
            <legend class="fieldset-legend">Description</legend>
            <textarea name="description" class="textarea h-24" placeholder="Bio"></textarea>
          </fieldset>
          <label class="input">
            Path
            <input name="thumbnail" type="text" class="grow" placeholder="images/example.png" />
          </label>
          <fieldset class="fieldset">
            <legend class="fieldset-legend">Thumbnail</legend>
            <input  type="file" accept="image/*" class="file-input" />
            <label class="fieldset-label">Max size 2MB</label>
          </fieldset>
          <fieldset class="fieldset">
            <legend class="fieldset-legend">Difficulty</legend>
            <select name="badge" class="select">
              <option selected>Beginner</option>
              <option>Intermediate</option>
              <option>Advanced</option>
            </select>
          </fieldset>
          <div>
            <x-button type="submit" primary label="Add Course" />
          </div>
        </form>
      </div>
    </section>
    <x-footer />
	</body>
</html>
