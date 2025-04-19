<?php

namespace App\Livewire;

use App\Models\CourseModuleContent;
use App\Models\Quiz;
use Livewire\Component;

class UpdateModuleContentQuizzes extends Component
{
    public CourseModuleContent $module_content;
    public $question;
    public $questionType = 'multiple_choice';
    public $questionOptions = [];
    public $correctAnswer;
    public $correctAnswerRaw; // used for enumeration textarea
    public $isUpdated = 'false';

    public function mount(CourseModuleContent $module_content) {
        $this->module_content = $module_content->load('contentQuizzes');;
    }

    public function save() {
        $this->validate([
            'question' => 'required|string',
            'questionType' => 'required|in:multiple_choice,true_false,enumeration',
        ]);

        $options = null;
        $correct = [];

        if ($this->questionType === 'multiple_choice') {
            $this->validate([
                'questionOptions' => 'required|array|min:2',
                'correctAnswer' => 'required',
            ]);
            $options = array_filter($this->questionOptions);
            $correct = [$options[$this->correctAnswer] ?? null];
        }

        if ($this->questionType === 'true_false') {
            $correct = [$this->correctAnswer];
        }

        if ($this->questionType === 'enumeration') {
            $this->validate([
                'correctAnswerRaw' => 'required|string',
            ]);
            $correct = array_filter(array_map('trim', explode("\n", $this->correctAnswerRaw)));
        }

        Quiz::create([
            'course_module_content_id' => $this->module_content->id,
            'question' => $this->question,
            'quiz_type' => $this->questionType,
            'options' => $options ? json_encode(array_values($options)) : null,
            'correct_answer' => json_encode($correct),
        ]);

        // Reset form
        $this->reset(['question', 'questionType', 'questionOptions', 'correctAnswer', 'correctAnswerRaw']);
    }
    
    public function render()
    {
        return view('livewire.update-module-content-quizzes');
    }
}