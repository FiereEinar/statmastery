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
		<form action="/v1/api/course" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="flex w-full">
        <div class="space-y-5 border-r border-neutral-content grow">
          {{-- Course Hero Section --}}
          <div class="relative py-8 pr-5 pl-32 bg-neutral-content/50 border-b-2 border-neutral-content space-y-5">
            <h1 class="text-3xl">Create Course</h1>
            <fieldset class="fieldset w-full">
              <legend class="fieldset-legend">Title</legend>
              <input value="{{ old('title', '') }}" type="text" id="title" name="title" class="input input-xl w-full">
              @error('title')
                <x-error-message>{{ $message }}</x-error-message>
              @enderror
            </fieldset>

            <fieldset class="fieldset w-full">
              <legend class="fieldset-legend">Description</legend>
              <textarea name="description" id="description" class="textarea h-24 w-full" placeholder="Type here">{{ old('description', '') }}</textarea>
              @error('description')
                <x-error-message>{{ $message }}</x-error-message>
              @enderror
            </fieldset>
          </div>

          {{-- Course Overview --}}
          <div class="py-8 pr-5 pl-32 space-y-5">
            <fieldset class="fieldset">
              <legend class="fieldset-legend">Overview</legend>
              <textarea name="overview" id="overview" rows="10" class="textarea w-full" placeholder="Type here">{{ old('overview', '') }}</textarea>
            </fieldset>
            @error('overview')
              <x-error-message>{{ $message }}</x-error-message>
            @enderror
          </div>
        </div>
        
        {{-- Course Right-Side Section --}}
        <div class="space-y-5 bg-neutral-content/50">
          {{-- Course Image --}}
          <div class="w-[500px]">
            <x-custom-image 
            source="/storage/nothing.png" 
            defaultImg="images/courses/placeholder.png"
            alt="Course image"
            className="w-full object-cover object-center"
            />
          </div>

          <fieldset class="fieldset px-8">
            <legend class="fieldset-legend">Choose an image (optional)</legend>
            <input type="file" name="thumbnail" class="file-input file-input-primary w-full" />
            @error('thumbnail')
              <x-error-message>{{ $message }}</x-error-message>
            @enderror
          </fieldset>

          {{-- Course Details --}}
          <div class="px-8">
            <fieldset class="fieldset w-full">
              <legend class="fieldset-legend">Price (P)</legend>
              <input value="{{ old('price', 0) }}" name="price" type="number" class="input validator w-full" placeholder="Enter here" />
              @error('price')
                <x-error-message>{{ $message }}</x-error-message>
              @enderror
            </fieldset>

            <fieldset class="fieldset w-full">
              <legend class="fieldset-legend">Time to complete</legend>
              <input value="{{ old('time_to_complete', '') }}" name="time_to_complete" type="text" class="input validator w-full" placeholder="Enter here" />
              @error('time_to_complete')
                <x-error-message>{{ $message }}</x-error-message>
              @enderror
            </fieldset>

            <fieldset class="fieldset w-full">
              <legend class="fieldset-legend">Difficulty</legend>
              <select name="badge_id" class="select w-full">
                @foreach ($courseBadges as $badge)
                  <option value="{{ $badge->id }}">{{ $badge->name }}</option>
                @endforeach
              </select>
              @error('badge_id')
                <x-error-message>{{ $message }}</x-error-message>
              @enderror
            </fieldset>

            <fieldset class="fieldset w-full">
              <legend class="fieldset-legend">Category</legend>
              <select name="category_id" class="select w-full">
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
              @error('category_id')
                <x-error-message>{{ $message }}</x-error-message>
              @enderror
            </fieldset>
          </div>

          {{-- Course Achievements --}}
          <div class="w-full h-1 border-b-2 border-neutral-content"></div>

          <div class="px-8 pb-5">
            <x-button type="submit" icon="plus" primary label="Add Course" class="w-full" />    
          </div>
        </div>
      </div>
    </form>
    <x-footer />
	</body>
</html>
