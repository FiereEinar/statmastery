<div>
  <x-custom-dialog title="Update Course Details">
    <form id="submit-update-course-form" class="w-full" action="/v1/api/course/{{ $course->id }}" method="POST">
      @csrf
      @method('PUT')
      <fieldset class="fieldset ">
        <legend class="fieldset-legend">Title</legend>
        <input value="{{ $course->title }}" name="title" type="text" class="input w-full" placeholder="Type here" />
      </fieldset>

      <fieldset class="fieldset">
        <legend class="fieldset-legend">Description</legend>
        <textarea name="description" class="textarea h-24 w-full" placeholder="Bio">{{ $course->description }}</textarea>
      </fieldset>

      <fieldset class="fieldset">
        <legend class="fieldset-legend">Path</legend>
        <input value="{{ $course->thumbnail }}" name="thumbnail" type="text" class="input w-full" placeholder="images/test.png" />
      </fieldset>

      <fieldset class="fieldset">
        <legend class="fieldset-legend">Overview</legend>
        <textarea name="overview" class="textarea h-24 w-full" placeholder="Bio">{{ $course->overview }}</textarea>
      </fieldset>

      <fieldset class="fieldset">
        <legend class="fieldset-legend">Thumbnail</legend>
        <input  type="file" accept="image/*" class="file-input w-full" />
        <label class="fieldset-label">Max size 2MB</label>
      </fieldset>

      <div class="flex gap-2 w-full">
        <fieldset class="fieldset w-full">
          <legend class="fieldset-legend">Time to complete</legend>
          <input value="{{ $course->time_to_complete }}" name="time_to_complete" type="text" class="input validator w-full" required placeholder="Enter here" />
        </fieldset>
        
        <fieldset class="fieldset w-full">
          <legend class="fieldset-legend">Price (P)</legend>
          <input value="{{ $course->price }}" name="price" type="number" class="input validator w-full" required placeholder="Enter here" />
        </fieldset>
      </div>

      <div class="flex gap-2 w-full">
        <fieldset class="fieldset w-full">
          <legend class="fieldset-legend">Subcription Type</legend>
          <select name="subscription_type" class="select w-full">
            <option value="Free" {{ $course->subscription_type === 'Free' ? 'selected' : '' }}>Free</option>
            <option value="Paid" {{ $course->subscription_type === 'Paid' ? 'selected' : '' }}>Paid</option>
          </select>
        </fieldset>
        
        <fieldset class="fieldset w-full">
          <legend class="fieldset-legend">Difficulty</legend>
          <select name="badge" class="select w-full">
            <option value="Beginner" {{ $course->badge === 'Beginner' ? 'selected' : '' }}>Beginner</option>
            <option value="Intermediate" {{ $course->badge === 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
            <option value="Advanced" {{ $course->badge === 'Advanced' ? 'selected' : '' }}>Advanced</option>
          </select>
        </fieldset>
      </div>

      <!-- Alpine.js event listener -->
      <div x-data @submit-update-course-form.window="document.querySelector('#submit-update-course-form').submit();"></div>
      <div class="flex justify-end mt-5">
        <x-button type="submit" primary label="Update" />
      </div>
    </form>
  </x-custom-dialog>

  <x-button wire:click="showDialog" icon="pencil" outline sm primary label="Update Details" />
</div>
