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
        <form method="POST" action="{{ route('password.email') }}" class="bg-[#123f74] relative w-[450px] h-[480px] rounded-md">
          <div class="w-[450px] h-[480px] bg-[#174e90] absolute top-3 left-3 space-y-10 rounded-md shadow-xl px-8 py-15 ">
            @csrf
            <div class="text-neutral-content">
              <h4 class="font-semibold text-xl">Enter your email</h4>
              <p>Enter your email to reset your password</p>
            </div>
            <div class="space-y-2">
              <div class="flex flex-col gap-1">
                <label class="input validator w-full">
                  <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></g></svg>
                  <input class="w-full" value="{{ old('email', '') }}" name="email" type="email" required placeholder="example@gmail.com" />
                </label>
                @error('email')<span class="text-xs text-error">{{ $message }}</span>@enderror
              </div>
              
              @if (session('status'))
                <div class="text-xs text-success">
                    {{ session('status') }}
                </div>
              @endif
              @error('all')<span class="text-xs text-error">{{ $message }}</span>@enderror
            </div>
            <div class="w-full flex flex-col justify-center items-center gap-3">
              <x-button class="w-full" type="submit" primary label="Send Password Reset Link" rounded="2xl" />
            </div>
          </div>
        </form>
      </div>
		</main>
	</body>
</html>
