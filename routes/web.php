<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});

Route::prefix('students')->controller(StudentController::class)->group(function () {
    Route::get('/', 'index')->name('students.index'); // Correspond à /students
    Route::post('/', 'store')->name('students.store'); // Correspond à /students
    Route::put('/{student}', 'update')->name('students.update'); // Correspond à /students/{student}
    Route::delete('/{student}', 'destroy')->name('students.destroy'); // Correspond à /students/{student}
});
Route::prefix('courses')->controller(CourseController::class)->group(function () {
    Route::get('/', 'index')->name('courses.index');
    Route::post('/', 'store')->name('courses.store');
    Route::put('/{course}', 'update')->name('courses.update');
    Route::delete('/{course}', 'destroy')->name('courses.destroy');
});

Route::prefix('lecturers')->controller(LecturerController::class)->group(function () {
    Route::get('/', 'index')->name('lecturers.index'); // Correspond à /lecturers
    Route::post('/', 'store')->name('lecturers.store'); // Correspond à /lecturers
    Route::Put('/{lecturer}', 'update')->name('lecturers.update'); // Correspond à /lecturers/{lecturer}
    Route::delete('/{lecturer}', 'destroy')->name('lecturers.destroy'); // Correspond à /lecturers/{lecturer}
});
