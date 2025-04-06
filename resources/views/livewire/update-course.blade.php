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
                <div class="collapse-title font-semibold flex items-center gap-2 max-w-[400px]">
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
                    <button onclick="setDisabled(false); setTinyMCEContent('{{ $content->content }}')" class="transition-all w-full flex items-center gap-1 p-3 cursor-pointer hover:bg-neutral-content">
                        <div class="rounded-full size-4 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-2" /></div>
                        <p class="truncate">{{ $content->title }}</p>
                    </button>
                    @endforeach
                    <x-button wire:click="showAddModuleContentDialog({{ $module->id }})" type="button" class="w-full" flat squared label="Add Content" icon="plus" />
                </div>
            </div>
            @endforeach
            {{-- <button onclick="tinymce.activeEditor.options.set('disabled', false)">click</button> --}}
        </div>
        <livewire:add-module-content-dialog />
        <livewire:add-course-module-dialog :course="$course" />
    </aside>

    {{-- Main content --}}
    <main class="bg-neutral-content w-full min-h-full p-3" wire:ignore> 
      <x-forms.tinymce-editor />
    </main>
</section>