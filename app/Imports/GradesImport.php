<?php

namespace App\Imports;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GradesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $student = Student::where('user_id', $row['student_id'])->first();
        $course = Course::where('id', $row['course_id'])->first();

        if ($student && $course) {
            return new Grade([
                'student_id' => $student->id,
                'course_id' => $course->id,
                'score' => $row['score'],
                'grade' => $row['grade'],
            ]);
        }
    }
}
