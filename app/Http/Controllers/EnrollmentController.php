<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;

use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $students = Student::all(); // Récupérer tous les students
        $courses = Course::all(); // Récupérer tous les courses
        $enrollments = Enrollment::with('student', 'course')->get(); // Récupérer les inscriptions avec leur student et cours associé

        return view('pages.enrollments.index', compact('enrollments', 'courses', 'students'));
    }

    public function store(){

        $validatedData = request()->validate([
            'student_id' => 'required',
            'course_id' => 'required',

        ]);

        Enrollment::create($validatedData);
        return redirect(route('enrollments.index'))->with('success', 'Enrollment created successfully');
    }

    public function update(Request $request, Enrollment $enrollment){

        $validatedData = $request->validate([
            'student_id' => 'required',
            'course_id' => 'required',
        ]);

        $enrollment->update($validatedData);
        return redirect(route('enrollments.index'))->with('success', 'Enrollment updated successfully');

    }


    public function destroy(Enrollment $enrollment){
        $enrollment->delete();
        return redirect(route('enrollments.index'))->with('success', 'Enrollment deleted successfully');
    }
}
