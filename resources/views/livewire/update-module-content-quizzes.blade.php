<div class="w-full bg-white rounded-b-md p-5">
    <div class="space-y-5">
        @forelse ($moduleContent->contentQuizzes as $quiz)
            <article class="rounded border border-neutral-content p-4 shadow-sm">
                <h4 class="mb-3 font-semibold text-lg">
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
                                name="quiz_{{ $quiz->id }}"
                                id="quiz-{{ $quiz->id }}-option-{{ $index }}"
                                class="radio radio-primary"
                            />
                            <span>{{ $option }}</span>
                        </label>
                    @endforeach
    
                @elseif ($quiz->quiz_type === 'true_false')
                    <label class="flex items-center space-x-2 mb-2">
                        <input type="radio" name="quiz_{{ $quiz->id }}" class="radio radio-primary" value="True" />
                        <span>True</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="quiz_{{ $quiz->id }}" class="radio radio-primary" value="False" />
                        <span>False</span>
                    </label>
    
                @elseif ($quiz->quiz_type === 'enumeration')
                    <div class="space-y-2">
                        @for ($i = 0; $i < count($quiz->correct_answers ?? []); $i++)
                            <input
                                type="text"
                                name="quiz_{{ $quiz->id }}_enum_{{ $i }}"
                                class="input input-bordered w-full"
                                placeholder="Answer {{ $i + 1 }}"
                            />
                        @endfor
                    </div>
                @endif
            </article>
        @empty
            <p class="text-gray-500 text-center italic">No quiz questions added yet.</p>
        @endforelse
    </div>
</div>
