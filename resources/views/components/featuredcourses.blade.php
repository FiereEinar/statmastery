@php
    $stats = [
        [
            'title' => '18,000+',
            'description' => 'Students empowered to succeed in math',
        ],
        [
            'title' => '1,250+',
            'description' => 'Educators trust our curriculum',
        ],
        [
            'title' => '94%',
            'description' => 'Report improved confidence in math and problem-solving',
        ],
    ]
@endphp

<section class="flex flex-col gap-8 justify-center items-center w-full min-h-[80dvh] px-40 py-10 bg-neutral-content/50">
    <div class="mt-[-100px] mb-10 border border-neutral-content w-[1000px] p-5 bg-white rounded-2xl shadow-md flex flex-wrap justify-center items-start gap-4">
        @foreach ($stats as $stat)
        {{-- divider --}}
        @if (!$loop->first)
        <div class="h-[50px] w-[1px] bg-neutral-content"></div>
        @endif
        <div class="flex flex-col justify-start items-center gap-2 w-[250px]">
            <h1 class="text-center font-semibold text-2xl">{{ $stat['title'] }}</h1>
            <p class="text-center text-base-content/50">{{ $stat['description'] }}</p>
        </div>
        @endforeach
    </div>

    <h1 class="text-2xl">Our <span class="text-blue-800">Popular</span> Courses</h1>
    <div class="flex gap-4 flex-wrap justify-center items-center">
    @foreach ($courses as $course)
        <x-course-card :course="$course" />
    @endforeach
    </div>
    <div class="flex justify-center w-full">
        <a href="/course">
            <x-button rounded="2xl" outline info label="View All Courses" />
        </a>
    </div>
</section>