<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        return view('auth.changePassword');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function store(PasswordRequest $request)
    {
        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        $newPasswordStatus = Hash::check($request->new_password,auth()->user()->password);
        if (!$currentPasswordStatus) {
            return back()->with('error', 'old password Doesnt match');
        }
        if ($newPasswordStatus) {
            return back()->with('error', 'new password Must not match old password');
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return redirect()->route('profile.info')->with('success', 'Password Updated Successfully');
    }
}
