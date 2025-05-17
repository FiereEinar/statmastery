<section class="flex justify-center items-center min-h-[70dvh] boxed-bg">
    <div class="relative space-y-2 w-1/3 text-black/90">
        <div class="absolute top-[-60px] left-0 text-base-content/50 flex items-center gap-2 text-xs">
            <x-icon name="fire" class="size-8" />
            <div class="flex flex-col">
                <span class="font-semibold">The demand for math and analytical skills is rising!</span>
                <p>
                    See why thousands of learners have started their journey with our free 
                    <a href="/course/5" class="underline">Fundamentals of Algebra</a> 
                    course.</p>
            </div>
        </div>
        <h1 class="text-5xl">Master Mathematics with <span class="text-blue-800">Elson Salvan</span></h1>
        <p>Learn Quantitative Methods, Statistics, and More with Engaging Online Courses.</p>
        <div class="space-x-2">
            @auth
            <x-button href="/dashboard" primary label="Start Learning" />
            @else
            <x-button href="/signup" primary label="Sign Up Now" />
            @endauth
            <a href="/course">
                <x-button outline primary label="Browse Courses" />
            </a>
        </div>
    </div>
    <div class="w-1/3">
        <img src="{{ asset('images/hero-image.png') }}" alt="Hero image">
    </div>
</section>