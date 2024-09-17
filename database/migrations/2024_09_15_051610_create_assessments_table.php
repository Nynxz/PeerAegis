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

//        Schema::create('groups', function (Blueprint $table) {
//            $table->id();
//            $table->string('name');
//            $table->timestamps();
//        });
//
//        Schema::create('assessments_groups', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('assessment_id')->constrained('assessments');
//            $table->foreignId('group_id')->constrained('groups');
//        });
//
//        Schema::create('group_user', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('group_id')->constrained('groups');
//            $table->foreignId('user_id')->constrained('users');
//        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
//        Schema::dropIfExists('groups');
//        Schema::dropIfExists('assessments_groups');
//        Schema::dropIfExists('group_user');
    }
};
