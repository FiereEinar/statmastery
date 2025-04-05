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
    <x-head.tinymce-config/>
	</head>
	<body class="min-h-screen flex flex-col">
    <x-course-header :course="$course" />
		<section class="flex grow min-h-full">
      {{-- Course Outline sidebar --}}
      <aside class="min-h-full border-r-2 border-neutral-content w-fit max-w-[400px] shrink-0">
        <div class="flex items-center gap-2 px-5 py-3 border-b-2 border-primary">
          <x-icon name="clipboard-document-list" />
          <h1 class="text-2xl">Course Outline</h1>
        </div>
        <div>
          <div class="collapse collapse-arrow bg-base-100 border border-base-300">
            <input type="radio" name="my-accordion-2" checked="checked" />
            <div class="collapse-title font-semibold flex items-center gap-2">
              <div class="rounded-full size-6 shrink-0 border border-primary bg-primary flex items-center justify-center"><x-icon name="check" class="text-white size-4" /></div>
              <p>Module 1: Understanding Algebra</p>
            </div>
            <div class="collapse-content text-sm pl-10">
              <div class="flex items-center gap-1 p-2 rounded-md">
                <div class="rounded-full size-4 shrink-0 border border-primary bg-primary flex items-center justify-center"><x-icon name="check" class="text-white size-2" /></div>
                <p class="truncate">1.1: What is Algebra?</p>
              </div>
              <div class="flex items-center gap-1 p-2 rounded-md">
                <div class="rounded-full size-4 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-2" /></div>
                <p class="truncate">1.2: Variables, Constants, and Expressions</p>
              </div>
              <div class="flex items-center gap-1 p-2 rounded-md">
                <div class="rounded-full size-4 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-2" /></div>
                <p class="truncate">1.3: Translating Real-Life Problems into Algebraic Expressions</p>
              </div>
            </div>
          </div>
          
          <div class="collapse collapse-arrow bg-base-100 border border-base-300">
            <input type="radio" name="my-accordion-2" checked="checked" />
            <div class="collapse-title font-semibold flex items-center gap-2">
              <div class="rounded-full size-6 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-4" /></div>
              <p>Module 2: Operations & Properties</p>
            </div>
            <div class="collapse-content text-sm pl-10">
              <div class="flex items-center gap-1 p-2 rounded-md">
                <div class="rounded-full size-4 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-2" /></div>
                <p class="truncate">1.1: Order of Operations (PEMDAS)</p>
              </div>
              <div class="flex items-center gap-1 p-2 rounded-md">
                <div class="rounded-full size-4 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-2" /></div>
                <p class="truncate">1.2: Properties of Real Numbers (Commutative, Associative, Distributive)</p>
              </div>
              <div class="flex items-center gap-1 p-2 rounded-md">
                <div class="rounded-full size-4 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-2" /></div>
                <p class="truncate">1.3: Combining Like Terms & Simplifying Expressions</p>
              </div>
            </div>
          </div>

          <div class="collapse collapse-arrow bg-base-100 border border-base-300">
            <input type="radio" name="my-accordion-2" checked="checked" />
            <div class="collapse-title font-semibold flex items-center gap-2">
              <div class="rounded-full size-6 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-4" /></div>
              <p>Module 3: Linear Equations</p>
            </div>
            <div class="collapse-content text-sm pl-10">
              <div class="flex items-center gap-1 p-2 rounded-md">
                <div class="rounded-full size-4 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-2" /></div>
                <p class="truncate">1.1: One-Step and Two-Step Equations</p>
              </div>
              <div class="flex items-center gap-1 p-2 rounded-md">
                <div class="rounded-full size-4 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-2" /></div>
                <p class="truncate">1.2: Solving Equations with Variables on Both Sides</p>
              </div>
              <div class="flex items-center gap-1 p-2 rounded-md">
                <div class="rounded-full size-4 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-2" /></div>
                <p class="truncate">1.3: Word Problems Involving Linear Equations</p>
              </div>
            </div>
          </div>
        </div>

      </aside>
      {{-- Main content --}}
      <div class="bg-neutral-content w-full min-h-full p-3">
        <x-forms.tinymce-editor />
      </div>
    </section>
	</body>
</html>
