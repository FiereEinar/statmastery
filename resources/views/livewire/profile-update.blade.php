<div>
    <section class="flex justify-between px-28 py-10 bg-[url('../../public/images/profile-cover.png')] bg-cover bg-center">
        <div class="flex gap-4">
            <div class="relative">
                <label for="profile_picture" class="absolute cursor-pointer bottom-0 right-0 p-1 rounded-full bg-white">
                    <x-icon class="text-primary" name="camera" />
                </label>

                <input wire:model="profile_picture" type="file" hidden id="profile_picture">

                <x-custom-image 
                :source="'storage/' . ($user->profile_picture ?? 'nothing.png')" 
                defaultImg="images/user-placeholder.jpg"
                className="rounded-full size-24"
                :alt="auth()->user()->name . ' profile picture'" 
                />
            </div>
            <div class="flex flex-col justify-center text-neutral-content">
                <p>Welcome,</p>
                <h1 class="text-3xl">{{ $user->name }}</h1>
                <p class="text-xs text-neutral-content/50">{{ $user->email }}</p>
            </div>
        </div>
        <div>
        </div>
    </section>
  
    <section class="px-28 py-10">
        <div class="rounded-md border border-neutral-content p-8 space-y-5">
            <h1 class="text-2xl">Update Profile</h1>
            <div class="space-y-2">
                <div class="flex flex-col gap-1">
                    <span class="text-base-content/50">Fullname</span>
                    <label class="input validator w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></g></svg>
                        <input wire:model="name" class="w-full" name="name" type="input" minlength="3" required placeholder="Enter Fullname" />
                    </label>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-base-content/50">Email</span>
                    <label class="input validator w-full">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></g></svg>
                        <input wire:model="email" class="w-full" name="email" type="email" required placeholder="example@gmail.com" />
                    </label>
                </div>
            </div>
            <div>
                <x-button rounded="2xl" wire:click="updateProfile()">Save Changes</x-button>
            </div>
        </div>
    </section>
</div>
