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
				<x-button href="/user/progress/course/{{ $currentCourse->id }}" flat primary>
					<x-icon name="chevron-left" />
				</x-button>
				
				<h1 class="text-2xl">Submissions</h1>
				
				<h2 class="text-2xl ml-6">
						{{ $currentCourse->title }}
						<p class="text-base-content/70 text-xs">Created at: {{ $currentCourse->created_at->format('F j, Y g:i A') }}</p>
				</h2>
      </div>

			<div class="space-y-4">
        <div class="flex items-center gap-2">
					<div class="mask mask-squircle h-12 w-12">
						<x-custom-image 
						:source="'storage/' . ($student->profile_picture ?? 'nothing.png')" 
						defaultImg="images/user-placeholder.jpg"
						className="a"
						:alt="$student->name . ' profile picture'" 
						/>
					</div>
					<h2 class="text-xl">
						{{ $student->name }}
						<p class="text-base-content/70 text-xs">{{ $student->email }}</p>
					</h2>
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
                <th>Module Quiz</th>
                <th>Submission Date</th>
                <th>Score</th>
                <th>Percentage</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              <!-- row 1 -->
              @foreach ($courseQuizzes as $quiz)
              <tr>
                <th>
                  <label>
                    <input type="checkbox" class="checkbox" />
                  </label>
                </th>
                <td>
									<p class="font-bold">{{ $quiz->title }}</p>
                </td>
								@php
									$submission = $userQuizSubmissionsOnCourse->where('quiz_id', $quiz->id)->first();
									$created_at = $submission ? $submission->created_at->format('F j, Y g:i A') : '--';
									$score = $submission ? $submission->score : '--';
									$total = $quiz->contentQuizzes->count();
									$percentage = $submission ? $score / $total * 100 : '--';
								@endphp
                <td>{{ $created_at }}</td>
                <td>{{ $score }}/{{ $total }}</td>
                <td>{{ $submission ? '%' . number_format($percentage, 2) : '--' }}</td>
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
                <th>Module Quiz</th>
                <th>Submission Date</th>
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
