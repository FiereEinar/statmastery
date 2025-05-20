<section class="flex grow min-h-full">
    {{-- Course Outline sidebar --}}
    <aside class="relative pb-[8rem] min-h-full border-r-2 border-neutral-content w-fit max-w-[400px] shrink-0">
        {{-- Sidebar Tabs --}}
        <div class="flex">
            <button wire:click="setActiveSidebarTab(1)" class="cursor-pointer flex items-center gap-2 px-5 py-3 border-primary {{ $activeSidebarTab === 1 ? 'border-b-2' : '' }}">
                <x-icon name="clipboard-document-list" />
                <h1 class="text-xl">Course Outline</h1>
            </button>
            <button wire:click="setActiveSidebarTab(2)" class="cursor-pointer flex items-center gap-2 px-5 py-3 border-primary {{ $activeSidebarTab === 2 ? 'border-b-2' : '' }}">
                <x-icon name="folder" />
                <h1 class="text-xl">Resources</h1>
            </button>
        </div>

        {{-- Course Outline Tab --}}
        @if ($activeSidebarTab === 1)
        <div class="overflow-y-auto h-full max-h-[500px] max-w-[400px]">
            @if ($course->modules->isEmpty())
            <div class="flex items-center gap-2 px-5 py-3">
                <h1 class="italic text-base-content/70">No modules found</h1>
            </div>
            @endif
            @foreach ($course->modules as $module)
            @php
                $contentIds = $module->contents->pluck('id')->toArray();
                $unfinished = array_diff($contentIds, $userProgress);
                $isCompleted = count($unfinished) === 0 && count($contentIds) > 0;
            @endphp
            <div class="collapse collapse-arrow bg-base-100 border border-base-300 max-w-[400px]">
                <input type="radio" name="my-accordion-2" {{ $loop->first ? 'checked' : '' }} />
                <div class="collapse-title font-semibold flex items-center gap-3 max-w-[400px]">
                    <div 
                    class="rounded-full size-6 shrink-0 border border-primary flex items-center justify-center
                    {{ $isCompleted ? 'bg-primary' : '' }}"
                    >
                        <x-icon name="check" class="text-white size-4" />
                    </div>
                    <p class="truncate">{{ $module->title }}</p>
                </div>
                <div class="collapse-content text-sm pl-10 max-w-[400px]">
                    @if ($module->contents->isEmpty())
                    <div class="flex items-center gap-2 p-2">
                        <h1 class="italic text-base-content/70">No contents found</h1>
                    </div>
                    @endif
                    @foreach ($module->contents as $content)
                    <button 
                    wire:click="setActiveContent({{ $content }})" 
                    class="
                    transition-all w-full flex items-center gap-1 p-3 cursor-pointer hover:bg-neutral-content 
                    {{ $activeContent && $activeContent->id === $content->id ? 'bg-neutral-content/50' : '' }}
                    ">
                        <div class="
                        {{ in_array($content->id, $userProgress) ? 'bg-primary' : '' }} 
                        rounded-full size-4 shrink-0 border border-primary flex items-center justify-center
                        ">
                            <x-icon name="check" class="text-white size-2" />
                        </div>
                        <p class="truncate">{{ $content->title }}</p>
                    </button>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        {{-- Resources Tab --}}
        @elseif ($activeSidebarTab === 2)
            @if ($activeContent)
            <div class="overflow-y-auto h-full max-h-[500px] max-w-[400px]">
                {{-- Resources List --}}
                <div class="border-t border-base-content/50">
                    @if ($activeContent->resources->isEmpty())
                    <div class="flex items-center gap-2 p-4">
                        <h1 class="italic text-base-content/50">No resources found</h1>
                    </div>
                    @endif
                    <ul>
                        @foreach ($activeContent->resources as $resource)
                            <li>
                                <a class="transition-all flex items-center justify-between border-b border-base-content/50 p-2 hover:bg-neutral-content" href="{{ asset('storage/' . $resource->file_path) }}" target="_blank">
                                    <div class="flex items-center gap-2">
                                        <x-file-icon className="size-8" fileExt="{{ $resource->file_type }}" />
                                        <p class="truncate">{{ basename($resource->filename) }}</p>
                                    </div>
                                    <x-icon name="arrow-down-tray" />
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @else
            <div class="p-4">
                <h1 class="italic text-base-content/50">Select a content</h1>
            </div>
            @endif
        @endif
    </aside>

    {{-- Main content --}}
    <main class="bg-neutral-content w-full min-h-full p-3"> 
        <div class="w-full p-3 bg-white border-b-2 border-neutral-content flex justify-between items-center">
            <div class="flex items-center">
                <x-icon name="document-text" />
                @if (!$activeContent)
                <h1 class="ml-2 italic text-base-content">Select a content</h1>
                @else
                <h1 class="ml-2">{{ $activeContent->title }}</h1>
                @endif
            </div>
            <div>
                @if ($activeContent)
                    @if ($activeContent->content_type->name !== 'quiz')
                    <x-button wire:click="markAsCompleted" outline xs icon="check" label="Mark as Completed" />
                    @endif
                @endif
            </div>
        </div>
                
        <div class="relative h-[600px] bg-white shadow text-wrap space-y-3 overflow-y-auto">
            <div id="loading-spinner" class="{{ $activeSidebarTab === 1 ? '' : 'hidden' }} w-full h-full absolute top-0 left-0 flex items-center justify-center bg-white bg-opacity-70 z-10">
                <div class="loader"></div> 
            </div>
            
            @if ($activeContent)
            {{-- QUIZ TYPE CONTENT --}}
            <div class="w-full bg-white rounded-b-md p-5 {{ $activeContent && $activeContent->content_type->name === 'quiz' ? ' ' : 'hidden' }}">
                @if ($activeContent->content_type->name === 'quiz')
                <livewire:module-content-quiz :moduleContent="$activeContent" />
                @endif
            </div>

            {{-- REGULAR TYPE CONTENT --}}
            <div class="h-full {{ $activeContent && $activeContent->content_type->name === 'content' ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none' }}">
                <div wire:ignore class="h-full">
                    <iframe 
                    id="content-frame"
                    class="w-full h-full border-none"
                    style="border: none;"
                    ></iframe>
                </div>
            </div>
            @endif
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                writeData(@json($activeContent->content ?? ''));
            });

            Livewire.on('content-updated', (data) => {
                writeData(data[0].content);
            });

            function writeData(content) {
                // Show spinner
                const iframe = document.getElementById('content-frame');
                if (!iframe) return;
                document.getElementById('loading-spinner').classList.remove('hidden');
                const doc = iframe.contentDocument || iframe.contentWindow.document;
                
                doc.open();
                doc.write(`
                    <html>
                        <head>
                            <!-- Fonts -->
                            <link rel="preconnect" href="https://fonts.bunny.net">
                            <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
                            <link rel="stylesheet" href="https://unpkg.com/style.css">
                            <style> 
                                * { 
                                    margin: 0; 
                                    padding: 0; 
                                    font-family: 'Instrument Sans', sans-serif; 
                                    word-break: break-word; 
                                    overflow-wrap: anywhere; 
                                    hyphens: auto;
                                } 
                                
                                body { 
                                    padding: 2rem;
                                }
                            </style>
                        </head>
                        <body>${content}</body>
                    </html>
                `);
                doc.close();

                // Auto-scroll to top
                iframe.contentWindow.scrollTo(0, 0);
                
                setTimeout(() => {
                    // Hide spinner
                    document.getElementById('loading-spinner').classList.add('hidden');
                }, 300);
            }
            </script>
    </main>
</section>