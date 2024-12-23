<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route d'accueil (affichage de la page de connexion)
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Routes d'authentification
Auth::routes();

// Route d'accueil protégée par l'authentification
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Routes pour les étudiants
    Route::prefix('students')->name('students.')->group(function () {
        Route::controller(StudentController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::put('/{student}', 'update')->name('update');
            Route::delete('/{student}', 'destroy')->name('destroy');
        });
    });

    // Routes pour les cours
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::controller(CourseController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::put('/{course}', 'update')->name('update');
            Route::delete('/{course}', 'destroy')->name('destroy');
        });
    });

    // Routes pour les enseignants
    Route::prefix('lecturers')->name('lecturers.')->group(function () {
        Route::controller(LecturerController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::put('/{lecturer}', 'update')->name('update');
            Route::delete('/{lecturer}', 'destroy')->name('destroy');
        });
    });

    // Routes pour les inscriptions
    Route::prefix('enrollments')->name('enrollments.')->group(function () {
        Route::controller(EnrollmentController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::put('/{enrollment}', 'update')->name('update');
            Route::delete('/{enrollment}', 'destroy')->name('destroy');
        });
    });

    // Routes pour les rôles
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::controller(RoleController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });
});
