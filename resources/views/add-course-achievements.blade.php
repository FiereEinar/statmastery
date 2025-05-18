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
		<x-welcome-admin-section :user="$user" :totalStudentCount="$currentCourse->students->count()" />
		<section class="px-28 py-10 space-y-6 min-h-[50vh]">
      <div class="flex items-center justify-between">
        <div class="flex justify-start items-center gap-4">
          <x-button href="/course/{{ $currentCourse->id }}/achievements" flat primary>
            <x-icon name="chevron-left" />
          </x-button>
          
          <h1 class="text-2xl">Achievements</h1>
          
          <h2 class="text-2xl ml-6">
              {{ $currentCourse->title }}
              <p class="text-base-content/70 text-xs">Created at: {{ $currentCourse->created_at->format('F j, Y g:i A') }}</p>
          </h2>
        </div>
      </div>

      <div class="w-full h-1 border-b-2 border-neutral-content"></div>

      <div>
        <h1 class="text-2xl">Add Achievement For This Course</h1>
        <form action="/v1/api/course/{{ $currentCourse->id}}/achievements/create" method="POST" enctype="multipart/form-data" class="max-w-[500px]">
          @csrf
          <fieldset class="fieldset w-full">
            <legend class="fieldset-legend">Title</legend>
            <input value="{{ old('title', '') }}" required name="title" type="text" class="input validator w-full" placeholder="Enter here" />
            @error('title')
              <x-error-message>{{ $message }}</x-error-message>
            @enderror
          </fieldset>

          <fieldset class="fieldset w-full">
            <legend class="fieldset-legend">Description</legend>
            <input value="{{ old('description', '') }}" required name="description" type="text" class="input validator w-full" placeholder="Enter here" />
            @error('description')
              <x-error-message>{{ $message }}</x-error-message>
            @enderror
          </fieldset>

          <fieldset class="fieldset">
            <legend class="fieldset-legend">Select an attachment (pdf/jpg/png)</legend>
            <input type="file" required name="file" class="file-input file-input-primary w-full" />
            @error('file')
              <x-error-message>{{ $message }}</x-error-message>
            @enderror
          </fieldset>
          <x-button class="mt-4" type="submit" primary>Submit</x-button>
        </form>
      </div>
    </section>
    <x-footer />
	</body>
</html>
