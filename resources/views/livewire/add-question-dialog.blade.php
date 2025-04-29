<div>
    <x-custom-dialog title="Add Question" dialogID="add-question-dialog">
      <form class="w-full" method="POST">
        @csrf
        {{-- ADD QUESTION FORM --}}
        <div class="space-y-6">
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Question</legend>
                <input wire:model="question" type="text" class="input w-full" placeholder="Type your question" />
                @error('question')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset w-full">
                <legend class="fieldset-legend">Question Type</legend>
                <select wire:model.live="questionType" class="select w-full">
                    <option value="multiple_choice" selected>Multiple Choice</option>
                    <option value="true_false">True or False</option>
                    <option value="enumeration">Enumeration</option>
                </select>
            </fieldset>

            @if ($questionType === 'multiple_choice')
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">Options</legend>
                    @for ($i = 0; $i < 4; $i++)
                        <div class="flex items-center space-x-2 mb-2">
                            <input type="radio" wire:model="correctAnswer" value="{{ $i }}" />
                            <input wire:model="questionOptions.{{ $i }}" type="text" class="input w-full" placeholder="Option {{ $i + 1 }}" />
                            @error("questionOptions.$i")
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endfor
                </fieldset>
            @elseif ($questionType === 'true_false')
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">Correct Answer</legend>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2">
                            <input type="radio" wire:model="correctAnswer" value="True" />
                            True
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" wire:model="correctAnswer" value="False" />
                            False
                        </label>
                    </div>
                </fieldset>
            @elseif ($questionType === 'enumeration')
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">Answers (One per line)</legend>
                    <textarea wire:model="correctAnswerRaw" class="textarea w-full" placeholder="Enter each answer on a new line"></textarea>
                </fieldset>
            @endif
        </div>

        <p class="text-red-500 text-xs mt-1">{{ $errorText }}</p>
  
        <div class="flex justify-end mt-5">
          <x-button wire:click="addQuestion" type="button" primary label="Add Question" />
        </div>
      </form>
    </x-custom-dialog>
</div>
  