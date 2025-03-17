<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function showUpdateProfilePictureForm()
    {
        return view('update');
    }

    public function updateProfilePicture(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3064', // Example validation rules
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        // Handle the file upload
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('profile_pictures', $filename, 'public'); // Store in storage/app/public/profile_pictures

            // Delete the old profile picture if it exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }
}
