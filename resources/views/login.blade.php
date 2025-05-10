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
		<main class="h-[100dvh] flex justify-center items-center gap-10 bg-[url('../../public/images/auth-bg.jpg')] bg-cover bg-center">
      <div>
        <div class="flex gap-2 items-center justify-center">
          <img src="{{ asset('images/app-logo.jpg') }}" class="size-20" alt="app logo">
          <h1 class="text-4xl"><span class="text-primary">Stat</span>Mastery</h1>
        </div>
        <div class="flex flex-col items-center justify-center">
          <img class="size-96" src="{{ asset('images/auth-hero.png') }}" alt="app heru img">
          <p class="text-center w-full">"Learn endlessly, Study Purposefully."</p>
        </div>
      </div>
      
      <div>
        <form action="/v1/api/login" method="POST" class="bg-[#123f74] relative w-[450px] h-[480px] rounded-md">
          <div class="w-[450px] h-[480px] bg-[#174e90] absolute top-3 left-3 space-y-10 rounded-md shadow-xl px-8 py-15 ">
            @csrf
            <div class="text-neutral-content">
              <h4 class="font-semibold text-xl">Welcome to StatMastery</h4>
              <p>Study smart. Learn deep. Rise strong</p>
            </div>
            <div class="space-y-2">
              <div>
                <label class="input validator w-full">
                  <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></g></svg>
                  <input class="w-full" value="{{ old('email', '') }}" name="email" id="email" type="email" required placeholder="example@gmail.com" />
                </label>
                @error('email')<x-error-message class="text-xs text-error">{{ $message }}</x-error-message>@enderror
              </div>
              <div>
                <label class="input validator w-full">
                  <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><path d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"></path><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle></g></svg>
                  <input class="w-full" name="password" id="password" type="password" minlength="3" required placeholder="Password" />
                </label>
                @error('password')<x-error-message class="text-xs text-error">{{ $message }}</x-error-message>@enderror
              </div>
              @error('all')<x-error-message class="text-xs text-error">{{ $message }}</x-error-message>@enderror
              <div class="text-xs text-neutral-content flex justify-between">
                <a class="underline" href="#">Terms and Conditions</a>
                <a class="underline" href="#">Forgot password?</a>
              </div>
            </div>
            <div class="w-full flex flex-col justify-center items-center gap-3">
              <x-button class="w-full" type="submit" primary label="Login" rounded="2xl" />
              <x-button href="/google/redirect" class="w-full" type="button" primary label="Login With Google" rounded="2xl" />
              <p class="text-xs text-neutral-content">Don&apos;t have an account? <a class="underline" href="/signup">Signup</a></p>
            </div>
          </div>
        </form>
      </div>
		</main>
	</body>
</html>
