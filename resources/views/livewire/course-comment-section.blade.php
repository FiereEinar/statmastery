<div class="space-y-3">
    <h1 class="text-xl">Comments</h1>

    {{-- Add Comment --}}
    <fieldset class="fieldset flex">
      <input wire:model="comment" wire:submit="addComment" name="comment" type="text" class="input w-full" placeholder="Add a comment" />
      <x-button wire:click="addComment" type="button" primary label="Comment" />
    </fieldset>

    {{-- No Comments --}}
    @if ($course->comments->isEmpty())
    <div class="flex items-center gap-2 p-2">
        <h1 class="italic text-base-content/50">No comments yet</h1>
    </div>
    @endif
    
    {{-- Comments --}}
    <div class="space-y-5">
        @foreach ($course->comments as $comment)
        <div>
        <div class="flex gap-3 items-center">
            <x-custom-image 
            :source="'storage/' . $comment->user->profile_picture ?? 'nothing.png'" 
            defaultImg="images/user-placeholder.jpg"
            className="rounded-full size-8"
            :alt="$comment->user->name . ' profile picture'" 
            />
            <div>
            <h4>{{ $comment->user->name }}</h4>
            <h4 class="text-xs text-base-content/50">{{ $comment->created_at }}</h4>
            </div>
        </div>
        <p class="pl-11 py-1">{{ $comment->text }}</p>
        </div>
        @endforeach
    </div>
</div>
