<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\CourseModule;
use App\Models\CourseModuleContent;
use App\Models\Quiz;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\WireUiActions;

class UpdateCourse extends Component
{
    use WithFileUploads;
    use WireUiActions;
    public Course $course;
    public CourseModuleContent $activeContent;
    public $editorContent;
    public $questionsCsv;

    protected $listeners = [
        'addCourseModule' => 'addCourseModule', 
        'addModuleContent' => 'addModuleContent',
        'saveContent' => 'saveContent',
        'saving' => 'saving',
        'saved'=> 'saved',
        'refresh-course'=> 'refreshCourse',
    ];

    public function mount(Course $course) {
        $this->course = $course;
    }

    public function refreshCourse() {
        $this->course->refresh();
    }

    public function showAddModuleContentDialog($moduleID) {
        $this->dispatch('openAddModuleContentDialog', $moduleID);
    }

    public function showUpdateCourseModuleDialog($moduleID) {
        $this->dispatch('openUpdateCourseModuleDialog', $moduleID);
    }

    public function showUpdateModuleContentDialog($contentID) {
        $this->dispatch('openUpdateModuleContentDialog', $contentID);
    }

    public function showAddQuestionDialog($moduleContentID) {
        $this->dispatch('showAddQuestionDialog', ['moduleContentID' => $moduleContentID]);
    }

    public function addCourseModule($data) {
        $data['course_id'] = $this->course->id;
        CourseModule::create($data);
        $this->course->refresh();
    }

    public function addModuleContent($data)  {
        CourseModuleContent::create($data);
        $this->course->refresh();
    }

    public function setActiveContent(CourseModuleContent $content) {
        $this->activeContent = $content;
    }

    public function saveContent() {
        if (!$this->editorContent) return;
        
        $this->activeContent->content = $this->editorContent;
        $this->activeContent->save();
        $this->course->refresh();
    }

    public function updatedQuestionsCsv()
    {
        $this->importQuestions();
    }

    public function importQuestions()
    {
        $this->validate([
            'questionsCsv' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $path = $this->questionsCsv->getRealPath();
        $file = fopen($path, 'r');

        $header = fgetcsv($file); // Read header

        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($header, $row);

            // Assumes columns: question, type, options (semicolon-separated), correct_answers (semicolon-separated)
            Quiz::create([
                'course_module_content_id' => $this->activeContent->id,
                'question' => $data['question'],
                'quiz_type' => $data['type'],
                'options' => json_encode(explode(';', $data['options'])),
                'correct_answer' => json_encode(explode(';', $data['correct_answers'])),
            ]);
        }

        fclose($file);
        $this->notification()->send([
            'icon' => 'success',
            'title' => 'File imported',
            'description' => 'File has been imported successfully.',
        ]);
    }
    
    public function render()
    {
        return view('livewire.update-course');
    }
}