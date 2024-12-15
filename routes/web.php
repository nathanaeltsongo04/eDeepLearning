<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Students', function(){
    return view('pages.students.index');
});
Route::get('/Lecturers', function(){
    return view('pages.lecturers.index');
});
