<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Admin routes

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
Route::get('students', [AdminController::class, 'showStudents'])->name('admin.showStudents')->middleware('auth');
Route::get('teachers', [AdminController::class, 'showTeachers'])->name('admin.showTeachers')->middleware('auth');
Route::get('courses', [AdminController::class, 'showCourses'])->name('admin.showCourses')->middleware('auth');
Route::get('register-student', [AdminController::class, 'showRegisterStudentForm'])->name('admin.showRegisterStudentForm')->middleware('auth');
Route::post('register-student', [AdminController::class, 'registerStudent'])->name('admin.registerStudent')->middleware('auth');
Route::get('add-course', [AdminController::class, 'showAddCourseForm'])->name('admin.showAddCourseForm')->middleware('auth');
Route::post('add-course', [AdminController::class, 'addCourse'])->name('admin.addCourse')->middleware('auth');
Route::get('register-teacher', [AdminController::class, 'showRegisterTeacherForm'])->name('admin.showRegisterTeacherForm')->middleware('auth');
Route::post('register-teacher', [AdminController::class, 'registerTeacher'])->name('admin.registerTeacher')->middleware('auth');


Route::get('grades', [TeacherController::class, 'showGrades'])->name('teacher.showGrades')->middleware('auth');
Route::get('grades/create', [TeacherController::class, 'createGrade'])->name('teacher.createGrade')->middleware('auth');
Route::post('grades', [TeacherController::class, 'storeGrade'])->name('teacher.storeGrade')->middleware('auth');
Route::get('grades/{id}/edit', [TeacherController::class, 'editGrade'])->name('teacher.editGrade')->middleware('auth');
Route::put('grades/{id}', [TeacherController::class, 'updateGrade'])->name('teacher.updateGrade')->middleware('auth');
Route::post('grades/upload', [TeacherController::class, 'uploadGrades'])->name('teacher.uploadGrades')->middleware('auth');
Route::delete('/teacher/grades/{id}', [TeacherController::class, 'deleteGrade'])->name('teacher.deleteGrade');
// Authentication routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::delete('/admin/students/{id}', [AdminController::class, 'deleteStudent'])->name('admin.deleteStudent');
Route::delete('/admin/teachers/{id}', [AdminController::class, 'deleteTeacher'])->name('admin.deleteTeacher');
// Admin registration routes
Route::get('register/admin', [AuthController::class, 'showRegisterAdminForm'])->name('register.admin');
Route::post('register/admin', [AuthController::class, 'registerAdmin'])->name('register.admin');
// Student routes
Route::prefix('student')->middleware(['auth'])->group(function () {
    Route::get('results', [StudentController::class, 'viewResults'])->name('student.viewResults');
    Route::get('results/download', [StudentController::class, 'downloadResults'])->name('student.downloadResults');
    Route::get('change-password', [StudentController::class, 'showChangePasswordForm'])->name('student.showChangePasswordForm');
    Route::post('change-password', [StudentController::class, 'changePassword'])->name('student.changePassword');
});
Route::get('/admin/export-data', [AdminController::class, 'exportData'])->name('admin.exportData');
Route::delete('/teacher/grades/{id}', [TeacherController::class, 'deleteGrade'])->name('teacher.deleteGrade')->middleware('auth');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('Edit_Profile')->middleware('auth'); // corrected route name
Route::get('/profile/update/picture', [ProfileController::class, 'showUpdateProfilePictureForm'])->name('profile.picture.edit');
Route::post('/profile/update/picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture.update');
Route::post('/profile/update', [ProfileController::class, 'updateProfilePicture'])->name('profile.update')->middleware('auth');
