<header class="sticky z-40 w-full top-0 bg-white flex items-center justify-between py-3 px-8 shadow">
    <div class="flex items-center gap-5"> 
        <a href="/" class="flex items-center gap-2 w-fit">
            <img class="w-10" src="{{ asset('images/app-logo.jpg') }}" alt="Logo">
            <h1 class="text-2xl"><span class="text-blue-800">Stat</span>Mastery</h1>
        </a>
        <div class="h-[2rem] border-l-2 border-neutral-content w-1"></div>
        <div class="flex items-center gap-2">
            <h1 class="text-2xl">{{ $course->title }}</h1>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <livewire:update-course-details-dialog :course="$course" />
        <x-button href="/course" icon="x-mark" outline sm negative label="Close" />
    </div>
</header>