<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses');
            $table->string('title');
            $table->string('instructions');
            $table->dateTime('due_date');
            $table->integer('required_reviews');
            $table->enum('type', ['student', 'teacher'])->nullable()->default('student');
            $table->string('minimum_grade');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
