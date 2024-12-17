<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});

// Routes pour les étudiants
Route::prefix('students')->name('students.')->controller(StudentController::class)->group(function () {
    Route::get('/', 'index')->name('index'); // GET /students
    Route::post('/', 'store')->name('store'); // POST /students
    Route::put('/{student}', 'update')->name('update'); // PUT /students/{student}
    Route::delete('/{student}', 'destroy')->name('destroy'); // DELETE /students/{student}
});

// Routes pour les cours
Route::prefix('courses')->name('courses.')->controller(CourseController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::put('/{course}', 'update')->name('update');
    Route::delete('/{course}', 'destroy')->name('destroy');
});

// Routes pour les enseignants
Route::prefix('lecturers')->name('lecturers.')->controller(LecturerController::class)->group(function () {
    Route::get('/', 'index')->name('index'); // GET /lecturers
    Route::post('/', 'store')->name('store'); // POST /lecturers
    Route::put('/{lecturer}', 'update')->name('update'); // PUT /lecturers/{lecturer}
    Route::delete('/{lecturer}', 'destroy')->name('destroy'); // DELETE /lecturers/{lecturer}
});

// Routes pour les inscriptions
Route::prefix('enrollments')->name('enrollments.')->controller(EnrollmentController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::put('/{enrollment}', 'update')->name('update');
    Route::delete('/{enrollment}', 'destroy')->name('destroy');
});
