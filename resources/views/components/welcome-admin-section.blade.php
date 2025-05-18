<section class="flex justify-between px-28 py-10 bg-[url('../../public/images/profile-cover.png')] bg-cover bg-center">
    <div class="flex gap-4">
        <div class="relative">
            <x-custom-image 
            :source="'storage/' . ($user->profile_picture ?? 'nothing.png')" 
            defaultImg="images/user-placeholder.jpg"
            className="rounded-full size-24"
            :alt="auth()->user()->name . ' profile picture'" 
            />
        </div>
        <div class="flex flex-col justify-center text-neutral-content">
            <p>Welcome, Admin!</p>
            <h1 class="text-3xl">{{ $user->name }}</h1>
            <p class="text-xs text-neutral-content/50">Keep track of your learner's progress</p>
        </div>
    </div>
    <div>
        @if($totalStudentCount !== 0)
        <div class="flex flex-col gap-2 items-center justify-center text-white">
            <h2 class="text-3xl flex items-center gap-2">
                <x-icon name="users" />
                {{ $totalStudentCount }}
            </h2>
            <p>Total Students</p>
        </div>
        @endif
    </div>
</section>