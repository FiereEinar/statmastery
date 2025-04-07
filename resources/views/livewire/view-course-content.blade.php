<section class="flex grow min-h-full">
    {{-- Course Outline sidebar --}}
    <aside class="relative pb-[8rem] min-h-full border-r-2 border-neutral-content w-fit max-w-[400px] shrink-0">
        <div class="flex items-center gap-2 px-5 py-3 border-b-2 border-primary">
            <x-icon name="clipboard-document-list" />
            <h1 class="text-2xl">Course Outline</h1>
        </div>
        <div class="overflow-y-auto h-full max-w-[400px]">
            @if ($course->modules->isEmpty())
            <div class="flex items-center gap-2 px-5 py-3">
                <h1 class="italic text-neutral-content">No modules found</h1>
            </div>
            @endif
            @foreach ($course->modules as $module)
            <div class="collapse collapse-arrow bg-base-100 border border-base-300 max-w-[400px]">
                <input type="radio" name="my-accordion-2" {{ $loop->first ? 'checked' : '' }} />
                <div class="collapse-title font-semibold flex items-center gap-3 max-w-[400px]">
                    <div class="rounded-full size-6 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-4" /></div>
                    <p class="truncate">{{ $module->title }}</p>
                </div>
                <div class="collapse-content text-sm pl-10 max-w-[400px]">
                    @if ($module->contents->isEmpty())
                    <div class="flex items-center gap-2 p-2">
                        <h1 class="italic text-neutral-content">No contents found</h1>
                    </div>
                    @endif
                    @foreach ($module->contents as $content)
                    <button 
                    wire:click="setActiveContent({{ $content }})" 
                    class="transition-all w-full flex items-center gap-1 p-3 cursor-pointer hover:bg-neutral-content {{ $activeContent && $activeContent->id === $content->id ? 'bg-neutral-content/50' : '' }}"
                    >
                        <div class="rounded-full size-4 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-2" /></div>
                        <p class="truncate">{{ $content->title }}</p>
                    </button>
                    @endforeach
                </div>
            </div>
            @endforeach
            {{-- <button onclick="tinymce.activeEditor.options.set('disabled', false)">click</button> --}}
        </div>
    </aside>

    {{-- Main content --}}
    <main class="bg-neutral-content w-full min-h-full p-3"> 
        <div class="w-full p-3 bg-white rounded-t-lg border-b-2 border-neutral-content flex justify-between items-center">
            @if (!$activeContent)
            <h1 class="ml-2 italic text-base-content">Select a content</h1>
            @else
            <h1 class="ml-2">{{ $activeContent->title }}</h1>
            @endif
        </div>
        <div class="bg-white rounded-b-md h-[600px] shadow p-5 text-wrap overflow-y-scroll space-y-3">
            {!! $activeContent->content ?? '' !!}
        </div>
    </main>
</section>