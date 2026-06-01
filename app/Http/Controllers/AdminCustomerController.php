<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiKhoan;

class AdminCustomerController extends Controller
{
    // =========================
    // DANH SÁCH KHÁCH HÀNG
    // =========================

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $users = TaiKhoan::where('VaiTro', 'user');

        if ($keyword) {
            $users->where(function ($query) use ($keyword) {
                $query->where('MaTaiKhoan', 'like', '%' . $keyword . '%')
                    ->orWhere('HoTen', 'like', '%' . $keyword . '%')
                    ->orWhere('TenDangNhap', 'like', '%' . $keyword . '%')
                    ->orWhere('Email', 'like', '%' . $keyword . '%');
            });
        }

        $users = $users->paginate(5);

        return view('admin.users.customers', compact('users'));
    }

    // =========================
    // CHI TIẾT KHÁCH HÀNG
    // =========================

    public function show($id)
    {
        $user = TaiKhoan::where('MaTaiKhoan', $id)->first();

        if (!$user || $user->VaiTro != 'user') {
            return redirect('/admin/customers');
        }

        return view('admin.users.user-detail', compact('user'));
    }

    // =========================
    // KHÓA / MỞ KHÓA KHÁCH HÀNG
    // =========================

    public function toggle($id)
    {
        $user = TaiKhoan::where('MaTaiKhoan', $id)->first();

        if (!$user) {
            return redirect('/admin/customers');
        }

        if ($user->VaiTro == 'admin') {
            return redirect('/admin/customers')
                ->with('error', 'Không thể khóa admin');
        }

        $user->TrangThai = $user->TrangThai == 1 ? 0 : 1;
        $user->save();

        return redirect('/admin/customers');
    }
}