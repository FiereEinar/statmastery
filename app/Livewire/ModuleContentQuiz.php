<?php

namespace App\Livewire;

use App\Models\CourseModuleContent;
use Livewire\Component;

class ModuleContentQuiz extends Component
{
    public CourseModuleContent $moduleContent;
    public $userAnswers = [];
    public $userScorePercentage = null;
    public $score = 0;

    public function mount(CourseModuleContent $moduleContent) {
        $this->moduleContent = $moduleContent;
    }

    public function submitQuiz() {
        if ($this->moduleContent->content_type->name !== 'quiz') return;
        
        $quizzes = $this->moduleContent->contentQuizzes;
        $this->score = 0;
        $total = $quizzes->count();

        foreach ($quizzes as $quiz) {
            $correctAnswers = is_array($quiz->correct_answer) ? $quiz->correct_answer : json_decode($quiz->correct_answer, true);
    
            if (isset($this->userAnswers[$quiz->id])) {
                $userAnswer = $this->userAnswers[$quiz->id];
    
                // if it's multiple correct answers (enumeration)
                if (is_array($userAnswer)) {
                    if (empty(array_diff($correctAnswers, $userAnswer))) {
                        $this->score++;
                    }
                } else {
                    if (in_array($userAnswer, $correctAnswers)) {
                        $this->score++;
                    }
                }
            }
        }

        $this->userScorePercentage = $total > 0 ? round(($this->score / $total) * 100) : 0;
    }

    public function render()
    {
        return view('livewire.module-content-quiz');
    }
}