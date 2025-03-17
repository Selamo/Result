<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GradesImport;

class TeacherController extends Controller
{
    public function showGrades()
    {
        $grades = Grade::with(['student.user', 'course'])->get();
        return view('teacher.grades', compact('grades'));
    }

    public function createGrade()
    {
        $students = Student::with('user')->get();
        $courses = Course::all();
        return view('teacher.add-grade', compact('students', 'courses'));
    }

    public function storeGrade(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'score' => 'required|integer',
            'grade' => 'required|string|max:2',
        ]);

        Grade::create([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
            'score' => $request->score,
            'grade' => $request->grade,
        ]);

        return redirect()->route('teacher.showGrades')->with('success', 'Grade added successfully.');
    }

    public function editGrade($id)
    {
        $grade = Grade::with(['student.user', 'course'])->findOrFail($id);
        return view('teacher.edit-grade', compact('grade'));
    }

    public function updateGrade(Request $request, $id)
    {
        $request->validate([
            'score' => 'required|integer',
            'grade' => 'required|string|max:2',
        ]);

        $grade = Grade::findOrFail($id);
        $grade->update([
            'score' => $request->score,
            'grade' => $request->grade,
        ]);

        return redirect()->route('teacher.showGrades')->with('success', 'Grade updated successfully.');
    }

    public function showUploadForm()
    {
        return view('teacher.grades.upload');
    }

    public function uploadGrades(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new GradesImport, $request->file('file'));

        return redirect()->route('teacher.showGrades')->with('success', 'Grades uploaded successfully.');
    }
}
