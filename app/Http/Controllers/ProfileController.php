<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function info()
    {

        $user = auth()->user();
        return view('auth.info', compact('user'));
    }

    /**
     * Edit profile information
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit()
    {
        $user = auth()->user();
        return view('auth.edit_profile', compact('user'));
    }

    /**
     * Update profile information
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        try {
            $user = auth()->user();
            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                if ($user->avatar) {
                    $oldAvatarPath = public_path($user->avatar);
                    if (file_exists($oldAvatarPath)) {
                        unlink($oldAvatarPath);
                    }
                }
                $user->avatar = 'images/' . $imageName;
            }
            $user->username = $request->input('user_name');
            $user->full_name = $request->input('full_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->sex = $request->input('sex');
            $user->brith_day = $request->input('brith_day');
            $user->save();
        } catch (\Exception $e) {
            return view('errors.404');
        }
        return redirect()->route('profile.info')->with('success', 'Thông tin của bạn đã được cập nhật.');
    }


}

