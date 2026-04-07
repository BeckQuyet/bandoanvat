<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Admin UserController - Quan ly nguoi dung he thong
 */
class UserController extends Controller
{
    // Danh sach nguoi dung, phan trang 15 dong
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    // Form tao nguoi dung moi
    public function create()
    {
        return view('admin.users.form');
    }

    // Luu nguoi dung moi vao CSDL
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Thêm người dùng thành công!');
    }

    // Form chinh sua nguoi dung
    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }

    // Cap nhat thong tin nguoi dung
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Chi cap nhat mat khau neu nhap moi
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công!');
    }

    // Xoa nguoi dung
    public function destroy(User $user)
    {
        // Khong cho xoa chinh minh
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Không thể xóa tài khoản của chính bạn!');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công!');
    }
}
