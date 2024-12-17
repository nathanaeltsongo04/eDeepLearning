<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function index(){

        $lecturers= Lecturer::all();
        return view('pages.lecturers.index', compact('lecturers'));
    }

    public function store(){

        $validatedData= request()->validate([
            'name' => 'required',
            'email' => 'required',
            'birth_date' => 'required',
            'country' => 'required',
        ]);

        Lecturer::create($validatedData);
        return redirect(route('lecturers.index'))->with('success', 'Lecturer created successfully');

    }

    public function destroy(Lecturer $lecturer){

        $lecturer->delete();
        return redirect(route('lecturers.index'))->with('success', 'Lecturer deleted successfully');

    }

    public function update(Request $request, Lecturer $lecturer){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'email' => 'required|email|unique:lecturers,email,' . $lecturer->id,
        ]);

        $lecturer->update($validatedData);

        return redirect()->route('lecturers.index')->with('success', 'Lecturer updated successfully!');

    }
}


