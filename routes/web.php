<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::prefix('students')->controller(StudentController::class)->group(function () {
    Route::get('/', 'index')->name('students.index'); // Correspond à /students
    Route::get('/create', 'create'); // Correspond à /students/create
    Route::post('/', 'store')->name('students.store'); // Correspond à /students
    Route::get('/{student}', 'show')->name('students.show'); // Correspond à /students/{student}
    Route::get('/{student}/edit', 'edit')->name('students.edit'); // Correspond à /students/{student}/edit
    Route::put('/{student}', 'update')->name('students.update'); // Correspond à /students/{student}
    Route::delete('/{student}', 'destroy')->name('students.destroy'); // Correspond à /students/{student}
});
Route::controller(CourseController::class)->group(function () {
    Route::get('/Courses', 'index');
    Route::get('/Courses/create', 'create');
    Route::post('/Courses', 'store');
    Route::get('/Courses/{course}', 'show');
    Route::get('/Courses/{course}/edit', 'edit');
    Route::put('/Courses/{course}', 'update');
    Route::delete('/Courses/{course}', 'destroy');
});
