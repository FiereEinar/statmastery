<div
    x-data="{ isOpen: false }"
    x-show="isOpen"
    x-transition
    class="fixed inset-0 flex items-center justify-center z-70 bg-black/50"
    style="display: none;"
>
    <div @click.away="isOpen = false" class="bg-neutral-content p-6 rounded-xl shadow-xl w-full max-w-lg  max-h-[600px] overflow-y-auto">
        <div x-data @do-show-dialog-event.window="
            $event.detail[0].dialogID === '{{ $dialogID }}' ? isOpen = true : isOpen = false;
        "></div>
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-gray-800">{{ $title }}</h2>
            <button @click="isOpen = false" class="text-gray-600 hover:text-gray-900 cursor-pointer">&times;</button>
        </div>
        <div class="text-gray-700">
            {{ $slot }}
        </div>
    </div>
</div>
