<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $students= Student::all();
        return view('pages.students.index', compact('students'));
    }

    public function store(){
        $validatedData= request()->validate([
            'name' => 'required',
            'email' => 'required',
            'birth_date' => 'required',
            'country' => 'required',
        ]);

        Student::create($validatedData);
        return redirect(route('students.index'))->with('success', 'Student created successfully');
    }

    public function destroy(Student $student){
        $student->delete();
        return redirect(route('students.index'))->with('success', 'Student deleted successfully');
    }

    public function update(Request $request, Student $student){
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ]);

        // Update the student
        $student->update($validatedData);

        // Redirect back with success message
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }
}
