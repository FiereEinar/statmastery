<div>
    <x-custom-dialog title="Update Course Module" dialogID="update-course-module-dialog">
      <form class="w-full" method="POST">
        @csrf
        @method('PUT')
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Title</legend>
          <input wire:model="title" type="text" class="input w-full" placeholder="Type here" />
        </fieldset>
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Module Number</legend>
          <input wire:model="module_number" type="number" class="input w-full" placeholder="0" />
        </fieldset>
  
        <div class="flex justify-end mt-5">
          <x-button wire:click="updateModule" type="button" primary label="Update Module" />
        </div>
      </form>
    </x-custom-dialog>
  </div>
  