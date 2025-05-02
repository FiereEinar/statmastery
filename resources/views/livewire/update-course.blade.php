<section class="flex grow min-h-full" x-data="{ saving: false }">
    {{-- Course Outline sidebar --}}
    <aside class="relative min-h-full border-r-2 border-neutral-content w-fit max-w-[400px] shrink-0">
        <div class="flex items-center gap-2 px-5 py-3 border-b-2 border-primary">
            <x-icon name="clipboard-document-list" />
            <h1 class="text-2xl">Course Outline</h1>
        </div>
        <div id="modules-container" class="overflow-y-auto h-full max-h-[500px] max-w-[400px]">
            @if ($course->modules->isEmpty())
            <div class="flex items-center gap-2 px-5 py-3">
                <h1 class="italic text-neutral-content">No modules found</h1>
            </div>
            @endif
            @foreach ($course->modules as $module)
            <div class="collapse collapse-arrow bg-base-100 border border-base-300 max-w-[400px]">
                <input type="radio" name="my-accordion-2" {{ $loop->first ? 'checked' : '' }} />
                <div class="relative collapse-title font-semibold flex items-center gap-3 max-w-[400px]">
                    <div class="rounded-full size-6 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-4" /></div>
                    <p class="truncate pr-5">{{ $module->title }}</p>
                    <div wire:click="showUpdateCourseModuleDialog({{ $module->id }})" class="transition-all absolute right-8 p-2 z-70 rounded-full hover:text-primary cursor-pointer shrink-0">
                        <x-icon name="pencil" class="size-5" />
                    </div>
                </div>
                <div class="collapse-content text-sm pl-10 max-w-[400px]">
                    @if ($module->contents->isEmpty())
                    <div class="flex items-center gap-2 p-2">
                        <h1 class="italic text-neutral-content">No contents found</h1>
                    </div>
                    @endif
                    @foreach ($module->contents as $content)
                    <button 
                    onclick="setDisabled(false); setTinyMCEContentFromEl(this)" 
                    data-content="{{ base64_encode($content->content) }}"
                    wire:click="setActiveContent({{ $content }})" 
                    class="transition-all relative w-full flex items-center gap-1 p-3 cursor-pointer hover:bg-neutral-content {{ $activeContent && $activeContent->id === $content->id ? 'bg-neutral-content/50' : '' }}"
                    >
                        <div class="rounded-full size-4 shrink-0 border border-primary flex items-center justify-center"><x-icon name="check" class="text-white size-2" /></div>
                        <p class="truncate pr-5">{{ $content->title }}</p>
                        <div wire:click="showUpdateModuleContentDialog({{ $content->id }})" class="transition-all absolute right-2 z-70 hover:text-primary p-2 rounded-full cursor-pointer shrink-0">
                            <x-icon name="pencil" class="size-3" />
                        </div>
                    </button>
                    @endforeach
                    <x-button wire:click="showAddModuleContentDialog({{ $module->id }})" type="button" class="w-full" flat squared label="Add Content" icon="plus" />
                </div>
            </div>
            @endforeach
        </div>
        <livewire:add-course-module-dialog :course="$course" />
    </aside>
    
    <livewire:add-module-content-dialog />
    <livewire:update-course-module-dialog />
    <livewire:update-module-content-dialog />
    <livewire:add-question-dialog />

    {{-- Main content --}}
    <main  class="bg-neutral-content w-full min-h-full p-3"> 
        <div class="w-full p-3 bg-white rounded-t-lg border-b-2 border-neutral-content flex justify-between items-center">
            @if (!$activeContent)
            <h1 class="ml-2 italic text-base-content">Select a content</h1>
            @else
            <h1 class="ml-2">{{ $activeContent->title }}</h1>
            @endif
            <div class="flex gap-2 items-center">
                <p class="text-sm pr-2 text-base-content/50" @saving.window="saving = true" @saved.window="saving = false" x-text="saving ? 'Saving...' : 'Saved'"></p>
                @if ($activeContent && $activeContent->content_type->name === 'quiz')
                <div x-data="{ openFile() { $refs.csvInput.click() } }">
                    <x-button @click="openFile" flat xs icon="document-arrow-up" label="Import Questions" />
                    
                    <input 
                        type="file" 
                        id="questions-csv" 
                        wire:model="questionsCsv" 
                        accept=".csv"
                        hidden
                        x-ref="csvInput"
                    />
                </div>
                <x-button wire:click="showAddQuestionDialog({{ $activeContent->id }})" flat xs icon="plus" label="Add Question" />
                @endif
            </div>

            {{-- Hidden input bound to Livewire --}}
            <input type="hidden" id="editorContent" wire:model="editorContent" />
        </div>

        <div>
            {{-- QUIZ TYPE CONTENT --}}
            <div class="{{ $activeContent && $activeContent->content_type->name === 'quiz' ? 'flex' : 'hidden' }}">
                @if ($activeContent)
                    <livewire:update-module-content-quizzes :moduleContent="$activeContent" />
                @endif
            </div>
            
            {{-- REGULAR TYPE CONTENT --}}
            <div class="{{ $activeContent && $activeContent->content_type->name === 'content' ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none' }}">
                <div wire:ignore>
                    <x-forms.tinymce-editor  />
                </div>
            </div>
        </div>
    </main>
</section>