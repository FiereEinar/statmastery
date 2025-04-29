<div class="space-y-5">
    @forelse ($moduleContent->contentQuizzes as $quiz)
        <article class="rounded border border-neutral-content p-4 shadow-sm {{ isset($userScorePercentage) ? 'pointer-events-none' : '' }}">
            <h4 class="mb-3 font-semibold text-lg flex items-center gap-3">
                {{-- logic for showing a check or x whether correct or not --}}
                @if ($userScorePercentage !== null && isset($userAnswers[$quiz->id]))
                    @php
                    $correctAnswers = is_array($quiz->correct_answer) ? $quiz->correct_answer : json_decode($quiz->correct_answer, true);
                    $userAnswer = $userAnswers[$quiz->id];
            
                    $isCorrect = false;
            
                    is_array($userAnswer) ?
                        $isCorrect = empty(array_diff($correctAnswers, $userAnswer))
                        : $isCorrect = in_array($userAnswer, $correctAnswers);
                    
                    @endphp
                
                    @if ($isCorrect)
                        <x-icon name="check" class="bg-green-400 p-1 rounded-full size-6" />
                    @else
                        <x-icon name="x-mark" class="bg-red-400 p-1 rounded-full size-6" />
                    @endif
                @endif

                {{ $quiz->question }}
                <span class="ml-2 px-2 py-0.5 text-xs rounded bg-gray-200 text-gray-700 uppercase">
                    {{ str_replace('_', ' ', $quiz->quiz_type) }}
                </span>
            </h4>

            @if ($quiz->quiz_type === 'multiple_choice')
                @foreach (json_decode($quiz->options, true) as $index => $option)
                    <label for="quiz-{{ $quiz->id }}-option-{{ $index }}" class="flex items-center space-x-2 mb-2">
                        <input
                            type="radio"
                            wire:model.live="userAnswers.{{ $quiz->id }}"
                            value="{{ $option }}"
                            id="quiz-{{ $quiz->id }}-option-{{ $index }}"
                            class="radio radio-primary"
                        />
                        <span class="{{ isset($correctAnswers) && in_array($option, $correctAnswers)  ? 'text-green-400' : '' }}">{{ $option }}</span>
                    </label>
                @endforeach

            @elseif ($quiz->quiz_type === 'true_false')
                <label class="flex items-center space-x-2 mb-2">
                    <input 
                        type="radio" 
                        wire:model.live="userAnswers.{{ $quiz->id }}" 
                        value="True" 
                        class="radio radio-primary" 
                    />
                    <span class="{{ isset($correctAnswers) && in_array("True", $correctAnswers)  ? 'text-green-400' : '' }}">True</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input 
                        type="radio" 
                        wire:model.live="userAnswers.{{ $quiz->id }}" 
                        value="False" 
                        class="radio radio-primary" 
                    />
                    <span class="{{ isset($correctAnswers) && in_array("False", $correctAnswers)  ? 'text-green-400' : '' }}">False</span>
                </label>

            @elseif ($quiz->quiz_type === 'enumeration')
                <div class="space-y-2">
                    @foreach (json_decode($quiz->correct_answer ?? '[]', true) as $i => $answer)
                        <input
                            type="text"
                            wire:model.live="userAnswers.{{ $quiz->id }}.{{ $i }}"
                            class="input input-bordered w-full"
                            placeholder="Answer {{ $i + 1 }}"
                        />
                    @endforeach
                </div>
            @endif
        </article>
    @empty
        <p class="text-gray-500 text-center italic">No quiz questions added yet.</p>
    @endforelse
    
    @if ($moduleContent->contentQuizzes->count() > 0)
    <div class="flex items-center gap-3">
        <x-button wire:click="submitQuiz()" primary lg label="Submit Quiz" />
    </div>
    @endif

    {{-- if the user submitted the quiz already, show thier score --}}
    @if ($userScorePercentage !== null)
        @php
        if ($userScorePercentage >= 80) {
            $borderColor = 'border-green-500';
        } elseif ($userScorePercentage >= 50) {
            $borderColor = 'border-yellow-400';
        } else {
            $borderColor = 'border-red-500';
        }
        @endphp

        <div class="flex flex-col items-center justify-center my-8 gap-3">
            <div class="flex items-center justify-center w-32 h-32 rounded-full border-8 {{ $borderColor }}">
                <span class="text-2xl font-bold text-gray-800">
                    {{ $userScorePercentage }}%
                </span>
            </div>
            <h1 class="text-xl">{{ $score }}/{{ $moduleContent->contentQuizzes->count() }}</h1>
            <h2 class="text-lg">Your Score</h2>
        </div>
    @endif
</div>
