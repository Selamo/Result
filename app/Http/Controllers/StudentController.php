<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDF;

class StudentController extends Controller
{
    public function viewResults()
    {
        $student = Auth::user()->student;
        $grades = $student->grades()->with('course')->get();
        return view('student.results', compact('grades'));
    }

    public function downloadResults()
    {
        $student = Auth::user()->student;
        $grades = $student->grades()->with('course')->get();
        $pdf = FacadePdf::loadView('student.results_pdf', compact('grades'));
        return $pdf->download('results.pdf');
    }

    public function showChangePasswordForm()
    {
        return view('student.change_password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }
}
