<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('auth.edit_profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            if ($user->avatar) {
                // Nếu có, xóa ảnh cũ
                $oldAvatarPath = public_path($user->avatar);
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }
            $user->avatar = 'images/' . $imageName;
        }
        $user->username = $request->input('username');
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->sex = $request->input('sex');
        $user->brith_day = $request->input('brith_day');
        $user->save();

        return redirect()->route('home.index')->with('success', 'Thông tin của bạn đã được cập nhật.');
    }


}

