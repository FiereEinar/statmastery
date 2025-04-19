<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_module_content_id')->constrained()->onDelete('cascade');
            $table->string('question');
            $table->enum('quiz_type', ['multiple_choice', 'true_false', 'enumeration']); 
            $table->json('options')->nullable(); 
            $table->json('correct_answer'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};