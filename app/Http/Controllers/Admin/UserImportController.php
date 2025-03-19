<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\StudentPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserImportController extends Controller
{
    public function showUploadForm()
    {
        return view('admin.upload');
    }

    public function importUsers(Request $request)
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
        if (count($rows) < 2) { // Changed to < 2, as we expect at least one data row
            return back()->with('error', 'The file is empty or lacks data.');
        }

        // Skip the header row and process the data
        foreach (array_slice($rows, 1) as $row) {
            // Validate data (adjust indexes as per your sheet structure)
            if (empty($row[0]) || empty($row[1]) || empty($row[2])) {
                continue; // Skip incomplete rows
            }

            // Create user
            $password = Str::random(8);
            $user = User::create([
                'name' => $row[0],
                'email' => $row[1],
                'password' => Hash::make($password),
                'role' => $row[2],
            ]);

            // Create associated student record only if user creation was successful
            if ($user) {
                Student::create([
                    'user_id' => $user->id,
                ]);
            }

            // Send email to the user with the password
            Mail::to($user->email)->send(new StudentPasswordMail($user->email, $password));
        }

        return back()->with('success', 'Students imported successfully!');
    } catch (\Exception $e) {
        return back()->with('error', 'Error importing students: ' . $e->getMessage());
    }
}
}
