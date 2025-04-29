<div>
    <x-custom-dialog title="Update Module Content" dialogID="update-module-content-dialog">
      <form class="w-full" method="POST">
        @csrf
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Title</legend>
          <input wire:model="title" type="text" class="input w-full" placeholder="Type here" />
        </fieldset>
        
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Content Number</legend>
          <input wire:model="content_number" type="number" class="input w-full" placeholder="0" />
        </fieldset>
  
        <div class="flex justify-end mt-5">
          <x-button wire:click="updateModuleContent" type="button" primary label="Update Content" />
        </div>
      </form>
    </x-custom-dialog>
</div>
  