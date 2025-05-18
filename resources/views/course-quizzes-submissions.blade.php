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
		<x-welcome-admin-section :user="$user" />
		<section class="px-28 py-10 space-y-6">
			<div class="flex justify-start items-center gap-4">
				<x-button href="/user/progress/course/{{ $currentCourse->id }}/quizzes" flat primary>
					<x-icon name="chevron-left" />
				</x-button>
				
				<h1 class="text-2xl">Submissions</h1>
				
				<h2 class="text-2xl ml-6">
						{{ $currentCourse->title }}
						<p class="text-base-content/70 text-xs">Created at: {{ $currentCourse->created_at->format('F j, Y g:i A') }}</p>
				</h2>
      </div>

			<div class="space-y-4">
        <div class="flex justify-between items-center gap-2">
          <div class="breadcrumbs text-sm">
            <ul>
              <li><a href="/user/progress/course/{{ $currentCourse->id }}/quizzes"><h2 class="text-xl">Course Quizzes</h2></a></li>
              <li><a><h2 class="text-xl">{{ $quiz->title }}</h2></a></li>
            </ul>
          </div>
					<div>
            <x-button target="__blank" href="/user/progress/course/1/quizzes/{{ $quiz->id }}/download" primary flat icon="arrow-down-tray" label="Download" />
          </div>
				</div>

        <div class="overflow-x-auto">
          <table class="table">
            <!-- head -->
            <thead>
              <tr>
                <th>
                  <label>
                    <input type="checkbox" class="checkbox" />
                  </label>
                </th>
                <th>Learner</th>
                <th>Submitted At</th>
                <th>Score</th>
                <th>Percentage</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              <!-- row 1 -->
              @foreach ($quiz->submissions as $submission)
              <tr>
                <th>
                  <label>
                    <input type="checkbox" class="checkbox" />
                  </label>
                </th>
                @php
                  $percentage = $submission->score / $quiz->contentQuizzes->count() * 100;
                @endphp
                <td>
									<p class="font-bold">{{ $submission->user->name }}</p>
                </td>
                <td>{{ $submission->created_at->format('F j, Y g:i A') }}</td>
                <td>{{ $submission->score }}/{{ $quiz->contentQuizzes->count() }}</td>
                <td>%{{ number_format($percentage, 2) }}</td>
                <th>
                  {{-- <a>
                    <button class="btn btn-ghost btn-xs">details</button>
                  </a> --}}
                </th>
              </tr>
              @endforeach
            </tbody>

            <!-- foot -->
            <tfoot>
              <tr>
                <th></th>
                <th>Learner</th>
                <th>Submitted At</th>
                <th>Score</th>
                <th>Percentage</th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>
			</div>
		</section>

    <x-footer />
	</body>
</html>
