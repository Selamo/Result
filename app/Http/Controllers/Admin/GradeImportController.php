<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GradeImportController extends Controller
{
    public function showUploadGradeForm()
    {
        return view('admin.importGrades');
    }

    public function importGrades(Request $request)
    {
        // Validate the file input
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        try {
            // Load the uploaded file
            $spreadsheet = IOFactory::load($request->file('file')->path());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Check if the file contains at least a header row and one data row
            if (count($rows) < 2) {
                return back()->with('error', 'The file is empty or lacks data.');
            }

            // Skip the header row and process the data
            foreach (array_slice($rows, 1) as $row) {
                // Validate data (ensure student_id, course_id, score, and grade exist)
                if (empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3])) {
                    continue; // Skip incomplete rows
                }

                // Check if the student exists
                $student = Student::find($row[0]);

                if ($student) {
                    // Insert grade for the existing student
                    Grade::create([
                        'student_id' => $student->id,
                        'course_id' => $row[1],
                        'score' => $row[2],
                        'grade' => $row[3],
                    ]);
                }
            }

            return back()->with('success', 'Marks uploaded successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error uploading marks: ' . $e->getMessage());
        }
    }
}
