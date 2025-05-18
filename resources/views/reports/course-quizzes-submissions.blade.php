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
		<section class="px-28 py-10 space-y-6">
			<div class="flex justify-start items-center gap-4">
				<h2 class="text-2xl ml-6">
						{{ $currentCourse->title }}, {{ $quiz->title }}
						<p class="text-base-content/70 text-xs">Created at: {{ $currentCourse->created_at->format('F j, Y g:i A') }}</p>
				</h2>
      </div>

			<div class="space-y-4">
        <div class="overflow-x-auto">
          <table class="table">
            <!-- head -->
            <thead>
              <tr>
                <th>Learner</th>
                <th>Submitted At</th>
                <th>Score</th>
                <th>Percentage</th>
              </tr>
            </thead>

            <tbody>
              <!-- row 1 -->
              @foreach ($quiz->submissions as $submission)
              <tr>
                @php
                  $percentage = $submission->score / $quiz->contentQuizzes->count() * 100;
                @endphp
                <td>
									<p class="font-bold">{{ $submission->user->name }}</p>
                </td>
                <td>{{ $submission->created_at }}</td>
                <td>{{ $submission->score }}/{{ $quiz->contentQuizzes->count() }}</td>
                <td>%{{ number_format($percentage, 2) }}</td>
              </tr>
              @endforeach
            </tbody>

            <!-- foot -->
            <tfoot>
              <tr>
                <th>Learner</th>
                <th>Submitted At</th>
                <th>Score</th>
                <th>Percentage</th>
              </tr>
            </tfoot>
          </table>
        </div>
			</div>
		</section>
	</body>
</html>
