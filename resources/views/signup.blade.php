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
	<body class="boxed-bg">
		<main class="h-[100dvh] flex justify-center items-center gap-10 bg-[url('../../public/images/auth-bg-transparent.png')] bg-cover bg-center">
      <div>
        <a hre="/" class="flex gap-2 items-center justify-center">
          <img src="{{ asset('images/app-logo.jpg') }}" class="size-20" alt="app logo">
          <h1 class="text-4xl"><span class="text-primary">Stat</span>Mastery</h1>
        </a>
        <div class="flex flex-col items-center justify-center">
          <img class="size-96" src="{{ asset('images/auth-hero.png') }}" alt="app heru img">
          <p class="text-center w-full">"Learn endlessly, Study Purposefully."</p>
        </div>
      </div>
      
      <div>
        <form action="/v1/api/signup" method="POST" class="bg-[#123f74] relative w-[450px] h-[550px] rounded-md">
          <div class="w-[450px] h-[550px] bg-[#174e90] absolute top-3 left-3 space-y-10 rounded-md shadow-xl px-8 py-15 ">
            @csrf
            <div class="text-neutral-content">
              <h4 class="font-semibold text-xl">Welcome to StatMastery</h4>
              <p>Study smart. Learn deep. Rise strong</p>
            </div>
            <div class="space-y-2">
              <div class="flex flex-col gap-1">
                <label class="input validator w-full">
                  <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></g></svg>
                  <input class="w-full" value="{{ old('name', '') }}" name="name" type="input" minlength="3" required placeholder="Fullname" />
                </label>
                @error('name')<span class="text-xs text-error">{{ $message }}</span>@enderror
              </div>
              <div class="flex flex-col gap-1">
                <label class="input validator w-full">
                  <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></g></svg>
                  <input class="w-full" value="{{ old('email', '') }}" name="email" type="email" required placeholder="example@gmail.com" />
                </label>
                @error('email')<span class="text-xs text-error">{{ $message }}</span>@enderror
              </div>
              <div class="flex flex-col gap-1">
                <label class="input validator w-full">
                  <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><path d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"></path><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle></g></svg>
                  <input class="w-full" name="password" type="password" minlength="3" required placeholder="Password" />
                </label>
                @error('password')<span class="text-xs text-error">{{ $message }}</span>@enderror
              </div>
              <div class="flex flex-col gap-1">
                <label class="input validator w-full">
                  <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><path d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"></path><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle></g></svg>
                  <input class="w-full" name="password_confirmation" type="password" minlength="3" required placeholder="Confirm password" />
                </label>
                @error('password_confirmation')<span class="text-xs text-error">{{ $message }}</span>@enderror
              </div>
              @error('all')<span class="text-xs text-error">{{ $message }}</span>@enderror
            </div>
            <div class="w-full flex flex-col justify-center items-center gap-3">
              <x-button class="w-full" type="submit" primary label="Signup" rounded="2xl" />
              <!-- Google Login -->
              <button onclick="loginWithGoogle()" type="button" class="btn rounded-2xl w-full bg-white text-black border-[#e5e5e5]">
                <svg aria-label="Google logo" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g><path d="m0 0H512V512H0" fill="#fff"></path><path fill="#34a853" d="M153 292c30 82 118 95 171 60h62v48A192 192 0 0190 341"></path><path fill="#4285f4" d="m386 400a140 175 0 0053-179H260v74h102q-7 37-38 57"></path><path fill="#fbbc02" d="m90 341a208 200 0 010-171l63 49q-12 37 0 73"></path><path fill="#ea4335" d="m153 219c22-69 116-109 179-50l55-54c-78-75-230-72-297 55"></path></g></svg>
                Signup with Google
              </button>
              <p class="text-xs text-neutral-content">Already have an account? <a class="underline" href="/login">Login</a></p>
            </div>
          </div>
        </form>
      </div>
		</main>
    <script>
      function loginWithGoogle() {
        window.location.href = '/google/redirect';
      }
    </script>
	</body>
</html>
