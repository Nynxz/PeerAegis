<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('teacher', function(User $user){
            return $user->role == 'teacher';
        });

        Gate::define('createAssessment', function (User $user, Course $course) {
            return $course->teachers()->where('user_id', $user->id)->exists();
        });
        //
    }
}
