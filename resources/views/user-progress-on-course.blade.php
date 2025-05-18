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

		@php
			$totalStudentCount = 0;

			foreach ($courses as $course) {
				$totalStudentCount += $course->students->count();
			}
		@endphp

		<section class="flex justify-between px-28 py-10 bg-[url('../../public/images/profile-cover.png')] bg-cover bg-center">
        <div class="flex gap-4">
            <div class="relative">
                <x-custom-image 
                :source="'storage/' . ($user->profile_picture ?? 'nothing.png')" 
                defaultImg="images/user-placeholder.jpg"
                className="rounded-full size-24"
                :alt="auth()->user()->name . ' profile picture'" 
                />
            </div>
            <div class="flex flex-col justify-center text-neutral-content">
                <p>Welcome, Admin!</p>
                <h1 class="text-3xl">{{ $user->name }}</h1>
                <p class="text-xs text-neutral-content/50">Keep track of your learner's progress</p>
            </div>
        </div>
        <div>
					<div class="flex flex-col gap-2 items-center justify-center text-white">
            <h2 class="text-3xl flex items-center gap-2">
							<x-icon name="users" />
							{{ $totalStudentCount }}
						</h2>
            <p>Total Students</p>
        	</div>
        </div>
    </section>

		<section class="px-28 py-10 space-y-6">
			<div class="flex justify-start items-center gap-4">
        <x-button href="/user/progress" flat primary>
          <x-icon name="chevron-left" />
        </x-button>
				
        <h1 class="text-2xl">Learners</h1>
        
        <h2 class="text-2xl ml-6">
            {{ $currentCourse->title }}
            <p class="text-base-content/70 text-xs">Created at: {{ $currentCourse->created_at }}</p>
        </h2>
			</div>

			<div class="space-y-4">
        @if ($currentCourse->students->count() == 0)
        <div class="flex items-center gap-2 px-5 py-3">
          <h1 class="italic text-base-content/70">No students yet</h1>
        </div>
        @endif

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
                <th>Name</th>
                <th>Enrolled At</th>
                <th>Progress</th>
                <th>Completed Contents</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              <!-- row 1 -->
              @foreach ($currentCourse->enrollments as $enrollment)
              <tr>
                <th>
                  <label>
                    <input type="checkbox" class="checkbox" />
                  </label>
                </th>
                <td>
                  <div class="flex items-center gap-3">
                    <div class="avatar">
                      <div class="mask mask-squircle h-12 w-12">
                        <x-custom-image 
                        :source="'storage/' . ($enrollment->user->profile_picture ?? 'nothing.png')" 
                        defaultImg="images/user-placeholder.jpg"
                        className="a"
                        :alt="$enrollment->user->name . ' profile picture'" 
                        />
                      </div>
                    </div>
                    <div>
                      <div class="font-bold">{{ $enrollment->user->name }}</div>
                      <div class="text-sm opacity-50">{{ $enrollment->user->email }}</div>
                    </div>
                  </div>
                </td>
                <td>{{ $enrollment->created_at }}</td>
                <td>%{{ number_format($usersProgress[$enrollment->user->id]['percentage'], 2) }}</td>
                <td>{{ $usersProgress[$enrollment->user->id]['completed'] }}/{{ $courseModuleContentCount }}</td>
                <th>
                  <a href="/user/{{ $enrollment->user->id }}">
                    <button class="btn btn-ghost btn-xs">details</button>
                  </a>
                </th>
              </tr>
              @endforeach
            </tbody>

            <!-- foot -->
            <tfoot>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Enrolled At</th>
                <th>Progress</th>
                <th>Completed Contents</th>
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
