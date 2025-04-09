<section class="flex flex-col gap-8 justify-center items-center w-full min-h-[80dvh] px-40 py-10 bg-neutral-content/50">
    <h1 class="text-2xl">Our <span class="text-blue-800">Popular</span> Courses</h1>
    <x-coursesplaceholder courses="6" />
    <div class="flex justify-center w-full">
        <a href="/course">
            <x-button rounded="2xl" outline info label="View All Courses" />
        </a>
    </div>
</section>