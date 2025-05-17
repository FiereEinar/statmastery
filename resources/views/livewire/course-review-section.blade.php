<div class="space-y-3">
    <h2 class="text-xl">Reviews</h2>
    
    {{-- Add Review --}}
    @if ($currentUser)
    <fieldset class="fieldset flex items-end">
        <div class="flex flex-col grow">
            <label for="review" class="text-xs text-base-content/50">Add Review:</label>
            <input wire:model="review" id="review" type="text" class="input w-full" placeholder="Write here" />
        </div>
        <div class="flex flex-col">
            <label for="stars" class="text-xs text-base-content/50">Stars:</label>
            <input wire:model.live="stars" id="stars" type="number" class="input w-14" />
        </div>
        <x-button wire:click="addReview" class="h-fit" type="button" primary label="Submit" />
    </fieldset>
    @endif

    @if ($course->reviews->isEmpty())
    <div class="flex items-center gap-2 p-2">
        <h1 class="italic text-base-content/50">No reviews yet</h1>
    </div>
    @endif
    
    <div class="space-y-5">
        @foreach ($course->reviews as $review)
        <div>
            <div class="flex gap-3 items-center">
                <x-custom-image 
                :source="'storage/' . ($review->user->profile_picture ?? 'nothing.png')" 
                defaultImg="images/user-placeholder.jpg"
                className="rounded-full size-8"
                :alt="$review->user->name . ' profile picture'" 
                />
                <div>
                    <div class="flex items-center">
                        <h4 class="mr-3">{{ $review->user->name }}</h4>
                        @for ($i = 1; $i <= $review->stars; $i++)
                        <x-icon name="star" class="size-3 fill-yellow-500 stroke-yellow-500" />
                        @endfor
                    </div>
                    <h4 class="text-xs text-base-content/50">{{ $review->created_at }}</h4>
                </div>
            </div>
            <p class="pl-11 py-1">{{ $review->text }}</p>
        </div>
        @endforeach
    </div>
</div>
