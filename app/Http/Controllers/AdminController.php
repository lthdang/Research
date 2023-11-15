<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function manageUsers()
    {
        // Lấy tất cả người dùng từ database
        $users = User::all();

        // Trả về view admin.users và truyền biến $users
        return view('admin.users', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function manageCategories()
    {
        // Logic quản lý thể loại
        return view('admin.categories');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function viewStatistics()
    {
        // Logic thống kê bài viết của người dùng
        return view('admin.statistics');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit()
    {
        $user = auth()->user();
        return view('admin.edit_profile_admin', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function info()
    {

        $user = auth()->user();
        return view('admin.admin_info', compact('user'));
    }

    /**
     * Update profile information
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminRequest $request)
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
        return redirect()->route('admin.info')->with('success', 'Thông tin của bạn đã được cập nhật.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function editUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.dashboard')->with('error', 'User not found.');
        }

        return view('admin.edit_user', compact('user'));
    }

}
