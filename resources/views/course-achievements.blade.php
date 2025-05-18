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
          <x-button href="/user/progress/course/{{ $currentCourse->id }}" flat primary>
            <x-icon name="chevron-left" />
          </x-button>
          
          <h1 class="text-2xl">Achievements</h1>
          
          <h2 class="text-2xl ml-6">
              {{ $currentCourse->title }}
              <p class="text-base-content/70 text-xs">Created at: {{ $currentCourse->created_at->format('F j, Y g:i A') }}</p>
          </h2>
        </div>

        <div class="space-x-4">
          <x-button href="/course/{{ $currentCourse->id }}/achievements/create" icon="plus" flat primary>Add Achievement</x-button>
        </div>
      </div>

      <div class="w-full h-1 border-b-2 border-neutral-content"></div>

			<div class="space-y-6">
				@if ($currentCourse->achievements->count() === 0)
					<p class="text-base-content/50 italic">No achievements for this course yet.</p>
				@endif

				@foreach ($courseAchievements as $achievement)
					<div class="bg-base-200 p-6 rounded-2xl shadow-md border border-base-300">
						<div class="flex items-start justify-between">
							<div>
								<h3 class="text-xl font-semibold text-base-content mb-1">{{ $achievement->title }}</h3>
								<p class="text-sm text-base-content/70">{{ $achievement->description }}</p>
								<p class="mt-2 text-xs text-base-content/50 italic">
									For course: <strong>{{ $achievement->course->title }}</strong>
								</p>
							</div>

							@php
								$fileUrl = Storage::disk('public')->url($achievement->file_path);
								$isImage = Str::endsWith($achievement->file_path, ['jpg', 'jpeg', 'png']);
							@endphp

							<div class="ml-6 shrink-0">
								@if ($isImage)
									<img src="{{ $fileUrl }}" alt="Achievement Image" class="w-24 h-24 object-cover rounded-xl border border-base-300 shadow-sm" />
								@else
									<div class="flex items-center gap-2">
										<svg class="w-10 h-10 text-primary" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
											<path d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6H6z" />
										</svg>
									</div>
								@endif
							</div>
						</div>

						{{-- <div class="mt-4">
							<a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-primary">
								Download Achievement
							</a>
						</div> --}}
					</div>
				@endforeach
			</div>
    </section>
    <x-footer />
	</body>
</html>
