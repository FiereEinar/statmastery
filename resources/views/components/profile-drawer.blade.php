<div x-data>
    <div class="drawer drawer-end">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Page content here -->
            <x-button 
            type="button" 
            icon="user-circle" 
            flat 
            primary 
            label="{{ auth()->user()->name }}"
            @click="document.getElementById('my-drawer-4').click()"
            />
        </div>
        <div class="drawer-side">
            <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="flex flex-col bg-base-200 text-base-content min-h-full pr-4">
                <div class="bg-neutral-content/50 py-3 px-5 flex items-center gap-3">
                    <x-custom-image 
                    :source="auth()->guard('web')->user()->profile_picture ?? 'nothing.png'" 
                    defaultImg="images/user-placeholder.jpg"
                    className="rounded-full w-12 h-12"
                    :alt="auth()->user()->name . ' profile picture'" 
                    />
                    <div>
                        <h2 class="text-2xl font-bold">{{ auth()->user()->name }}</h2>
                        <p class="text-sm opacity-50">{{ auth()->user()->email }}</p>
                    </div>
                    <form class="ml-8" action="/v1/api/logout" method="GET">
                        @csrf
                        <x-button rounded="3xl" xs icon="power" type="submit" primary outline label="Logout" />
                    </form>
                </div>
                <div class="px-5 py-8 space-y-4">
                    <div class="flex gap-1 items-center">
                        <x-icon name="squares-2x2" />
                        <h4 class="font-semibold">Dashboard</h4>
                    </div>
                    <a href="/dashboard" class="flex gap-1 items-center justify-between hover:text-primary">
                        <h4>My Learning</h4>
                        <x-icon class="text-primary" name="chevron-right" />
                    </a>

                    <div class="w-full border-b-2 border-neutral-content h-1 my-6"></div>

                    <div class="flex gap-1 items-center">
                        <x-icon name="book-open" />
                        <h4 class="font-semibold">Course</h4>
                    </div>
                    <a href="/course" class="flex gap-1 items-center justify-between hover:text-primary">
                        <h4>Browse Courses</h4>
                        <x-icon class="text-primary" name="chevron-right" />
                    </a>
                    <a href="/course/create" class="flex gap-1 items-center justify-between hover:text-primary">
                        <h4>Add Course</h4>
                        <x-icon class="text-primary" name="chevron-right" />
                    </a>

                    <div class="w-full border-b-2 border-neutral-content h-1 my-6"></div>
                    
                    <div class="flex gap-1 items-center">
                        <x-icon name="user-circle" />
                        <h4 class="font-semibold">Profile</h4>
                    </div>
                    <a href="/dashboard" class="flex gap-1 items-center justify-between hover:text-primary">
                        <h4>Update Profile</h4>
                        <x-icon class="text-primary" name="chevron-right" />
                    </a>
                    <a href="/dashboard" class="flex gap-1 items-center justify-between hover:text-primary">
                        <h4>Achievements</h4>
                        <x-icon class="text-primary" name="chevron-right" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>