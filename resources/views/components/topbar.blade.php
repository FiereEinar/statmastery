<header class="sticky z-70 w-full top-0 bg-white flex items-center justify-between py-3 px-8 shadow">
    <div class="flex items-center gap-2"> 
        <img class="w-10" src="{{ asset('images/app-logo.jpg') }}" alt="Logo">
        <h1 class="text-2xl"><span class="text-blue-800">Stat</span>Mastery</h1>
        <label class="input ml-5">
            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></g></svg>
            <input type="search" placeholder="Search courses"/>
        </label>
    </div>
    <div>
        @auth
        <p>Logged in</p>
        @else
        <x-button primary label="Login" />
        @endauth
    </div>
</header> 