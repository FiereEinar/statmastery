<section class="flex justify-center items-center min-h-[70dvh]">
    <div class="space-y-2 w-1/3 text-black/90">
        <h1 class="text-5xl">Master Mathematics with <span class="text-blue-800">Elson Salvan</span></h1>
        <p>Learn Quantitative Methods, Statistics, and More with Engaging Online Courses.</p>
        <div class="space-x-2">
            <a href="/course">
                <x-button outline primary label="Browse Courses" />
            </a>
            @auth
            @else
            <a href="/signup">
                <x-button primary label="Sign Up Now" />
            </a>
            @endauth
        </div>
    </div>
    <div class="w-1/3">
        <img class="" src="{{ asset('images/hero-image.png') }}" alt="Hero image">
    </div>
</section>