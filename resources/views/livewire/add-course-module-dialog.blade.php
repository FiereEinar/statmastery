<div>
  <x-custom-dialog title="Add Course Module" dialogID="add-course-module-dialog">
    <form id="submit-update-course-form" class="w-full" method="POST">
      @csrf
      <fieldset class="fieldset">
        <legend class="fieldset-legend">Title</legend>
        <input wire:model="title" type="text" class="input w-full" placeholder="Type here" />
      </fieldset>
      <fieldset class="fieldset">
        <legend class="fieldset-legend">Module Number</legend>
        <input wire:model="module_number" type="number" class="input w-full" placeholder="0" />
      </fieldset>

      <div class="flex justify-end mt-5">
        <x-button wire:click="addModule" type="button" primary label="Add Module" />
      </div>
    </form>
  </x-custom-dialog>

  <x-button wire:click="showDialog" class="absolute bottom-0 left-0 w-full py-5" squared icon="plus" label="Add Module" />
    {{-- <x-button wire:click="showDialog" icon="pencil" outline sm primary label="Update Details" /> --}}
</div>
