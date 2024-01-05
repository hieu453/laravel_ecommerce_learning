<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        return view('frontend.user.profile');
    }

    public function updateUserProfile(Request $request) {
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'digits:10'],
            'pin_code' => ['required', 'digits:6'],
            'address' => ['required', 'string', 'max:499']
        ]);

        $user = User::findOrFail(Auth::user()->id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->userDetail()->updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'phone' => $request->phone,
                'pin_code' => $request->pin_code,
                'address' => $request->address
            ],
        );

        return redirect()->back()->with('message', 'User Profile Updated');
    }

    public function showChangePasswordPage() {
        return view('frontend.user.change-password') ;
    }

    public function changePassword(Request $request) {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required','string','min:8','confirmed'],
        ]);

        $currentPassword = Hash::check($request->current_password, Auth::user()->password);

        if ($currentPassword) {
            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->back()->with('message', 'Password Updated');
        } else {
            return redirect()->back()->with('message', 'Current Password does not match with Old Password');
        }
    }
}
