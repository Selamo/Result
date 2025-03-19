<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    public function dashboard()
    {
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $courseCount = Course::count();

        // Fetch student performance data
        $students = Student::with('user', 'grades')->get();
        $studentNames = $students->pluck('user.name');
        $studentScores = $students->map(function ($student) {
            return $student->grades->avg('score');
        });

        // Fetch recent activities and notifications
        $recentActivities = [
            'Student John Doe registered',
            'Course Math 101 added',
            'Teacher Jane Smith registered'
        ];

        $notifications = [
            'Low performance alert for student John Doe',
            'Upcoming deadline for course Math 101'
        ];

        // Calculate performance summary
        $averageScore = $studentScores->avg();
        $passRate = $students->filter(function ($student) {
            return $student->grades->avg('score') >= 50;
        })->count() / $students->count() * 100;

        return view('admin.dashboard', compact('studentCount', 'teacherCount', 'courseCount', 'studentNames', 'studentScores', 'recentActivities', 'notifications', 'averageScore', 'passRate'));
    }

    public function showStudents()
    {
        $students = Student::with('user')->get();
        return view('admin.students', compact('students'));
    }

    public function showTeachers()
    {
        $teachers = Teacher::with('user')->get();
        return view('admin.teachers', compact('teachers'));
    }

    public function showCourses()
    {
        $courses = Course::all();
        return view('admin.courses', compact('courses'));
    }

    public function showRegisterStudentForm()
    {
        return view('admin.register-student');
    }

    public function registerStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $password = Str::random(8); // Generate a random password

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 'student',
        ]);

        Student::create([
            'user_id' => $user->id,
        ]);

        // Send email with password
        Mail::to($user->email)->send(new \App\Mail\StudentPasswordMail($user->email, $password));

        return redirect()->route('admin.dashboard')->with('success', 'Student registered successfully and password sent via email.');
    }

    public function showAddCourseForm()
    {
        return view('admin.add-course');
    }

    public function addCourse(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Course::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Course added successfully.');
    }

    public function showRegisterTeacherForm()
    {
        return view('admin.register_teacher');
    }

    public function registerTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $password = Str::random(8); // Generate a random password
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 'teacher',
        ]);

        Teacher::create([
            'user_id' => $user->id,
        ]);

        // Send email with password
        Mail::to($user->email)->send(new \App\Mail\TeacherPasswordMail($user->email, $password));

        return redirect()->route('admin.showRegisterTeacherForm')->with('success', 'Teacher registered successfully and password sent via email.');
    }

    public function deleteStudent($id)
    {
        $student = Student::findOrFail($id);
        $user = $student->user;
        $student->delete();
        $user->delete();

        return redirect()->route('admin.showStudents')->with('success', 'Student deleted successfully.');
    }

    public function deleteTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        $user = $teacher->user;
        $teacher->delete();
        $user->delete();

        return redirect()->route('admin.showTeachers')->with('success', 'Teacher deleted successfully.');
    }
}
