<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){

        $courses = Course::with('lecturer')->get(); // Récupérer les cours avec leur lecturer associé
        $lecturers = Lecturer::all(); // Récupérer tous les professeurs

        return view('pages.courses.index', compact('courses', 'lecturers'));
    }

    public function store(){
        $validatedData = request()->validate([
            'title'=>'required',
            'lecturer_id'=>'required',
            'description'=>'required',
        ]);

        Course::create($validatedData);
        return redirect(route('courses.index'))->with('success', 'Course created successfully');
    }

    public function update(Request $request, Course $course){

        $validatedData = $request->validate([
            'title' => 'required',
            'lecturer_id' => 'required',
            'description' => 'required',
        ]);

        $course->update($validatedData);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');

    }
}
