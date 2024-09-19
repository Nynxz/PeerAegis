<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('assessment_id')->constrained('assessments');
            $table->timestamps();
        });

        Schema::create('groups_users', function (Blueprint $table) {
            $table->primary(['group_id', 'user_id']);
            $table->foreignId('group_id')->constrained('groups');
            $table->foreignId('user_id')->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
        Schema::dropIfExists('groups_users');
    }
};
