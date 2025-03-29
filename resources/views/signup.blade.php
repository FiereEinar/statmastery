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
		<main class="h-[100dvh] flex justify-center items-center">
			<form class="space-y-5 shadow-xl px-5 py-10 bg-base-200 rounded-md" action="/v1/api/signup" method="POST">
        @csrf
        <div class="flex items-center gap-2">
          <img class="w-10 rounded-full" src="{{ asset('images/app-logo.jpg') }}" alt="Logo">
          <x-header-text>Sign up</x-header-text>
        </div>
        <div class="space-y-2">
          <div class="flex flex-col gap-1">
            <label class="input validator">
              <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></g></svg>
              <input value="{{ old('name', '') }}" name="name" type="input" minlength="3" required placeholder="Fullname" />
            </label>
            @error('name')<span class="text-xs text-error">{{ $message }}</span>@enderror
          </div>
          <div class="flex flex-col gap-1">
            <label class="input validator">
              <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></g></svg>
              <input value="{{ old('email', '') }}" name="email" type="email" required placeholder="example@gmail.com" />
            </label>
            @error('email')<span class="text-xs text-error">{{ $message }}</span>@enderror
          </div>
          <div class="flex flex-col gap-1">
            <label class="input validator">
              <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><path d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"></path><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle></g></svg>
              <input name="password" type="password" minlength="3" required placeholder="Password" />
            </label>
            @error('password')<span class="text-xs text-error">{{ $message }}</span>@enderror
          </div>
          <div class="flex flex-col gap-1">
            <label class="input validator">
              <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><path d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"></path><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle></g></svg>
              <input name="confirmPassword" type="password" minlength="3" required placeholder="Confirm password" />
            </label>
            @error('confirmPassword')<span class="text-xs text-error">{{ $message }}</span>@enderror
          </div>
          @error('all')<span class="text-xs text-error">{{ $message }}</span>@enderror
        </div>

        <p class="text-xs text-base-content/70">By signing up, you agree to our <a class="underline" href="#">Terms and Conditions</a></p>

        <div class="flex justify-end gap-2">
          <a href="/login">
                <x-button sm type="button" flat primary label="Login" />
          </a>
          <x-button sm type="submit" primary label="Signup" />
        </div>
      </form>
		</main>
	</body>
</html>