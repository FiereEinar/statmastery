<div>
    <x-custom-dialog title="Add Course" dialogID="add-course-dialog">
      <form id="submit-update-course-form" class="w-full" action="/v1/api/course" method="POST">
        @csrf
        <fieldset class="fieldset ">
          <legend class="fieldset-legend">Title</legend>
          <input name="title" type="text" class="input w-full" placeholder="Type here" />
        </fieldset>
  
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Description</legend>
          <textarea name="description" class="textarea h-24 w-full" placeholder="Type here"></textarea>
        </fieldset>
  
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Path</legend>
          <input name="thumbnail" type="text" class="input w-full" placeholder="images/test.png" />
        </fieldset>
  
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Overview</legend>
          <textarea name="overview" class="textarea h-24 w-full" placeholder="Type here"></textarea>
        </fieldset>
  
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Thumbnail</legend>
          <input  type="file" accept="image/*" class="file-input w-full" />
          <label class="fieldset-label">Max size 2MB</label>
        </fieldset>
  
        <div class="flex gap-2 w-full">
          <fieldset class="fieldset w-full">
            <legend class="fieldset-legend">Time to complete</legend>
            <input name="time_to_complete" type="text" class="input validator w-full" required placeholder="Enter here" />
          </fieldset>
          
          <fieldset class="fieldset w-full">
            <legend class="fieldset-legend">Price (P)</legend>
            <input name="price" type="number" class="input validator w-full" required placeholder="Enter here" />
          </fieldset>
        </div>
  
        <div class="flex gap-2 w-full">
          <fieldset class="fieldset w-full">
            <legend class="fieldset-legend">Subcription Type</legend>
            <select name="subscription_type" class="select w-full">
              <option value="Free">Free</option>
              <option value="Paid">Paid</option>
            </select>
          </fieldset>
          
          <fieldset class="fieldset w-full">
            <legend class="fieldset-legend">Difficulty</legend>
            <select name="badge" class="select w-full">
              <option value="Beginner" >Beginner</option>
              <option value="Intermediate" >Intermediate</option>
              <option value="Advanced" >Advanced</option>
            </select>
          </fieldset>
        </div>
  
        <div class="flex justify-end mt-5">
          <x-button type="submit" primary label="Add Module" />
        </div>
      </form>
    </x-custom-dialog>

    <x-button wire:click="showDialog" icon="plus" primary label="Add Course" />    
</div>
  