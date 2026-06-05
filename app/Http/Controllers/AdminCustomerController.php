<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiKhoan;

class AdminCustomerController extends Controller
{
    // ===================================================
    // DANH SÁCH KHÁCH HÀNG
    // ===================================================
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $status = $request->status; // <--- THÊM DÒNG NÀY

        $users = TaiKhoan::where('VaiTro', 'user');

        if ($keyword) {
            $users->where(function ($query) use ($keyword) {
                $query->where('MaTaiKhoan', 'like', '%' . $keyword . '%')
                    ->orWhere('HoTen', 'like', '%' . $keyword . '%')
                    ->orWhere('TenDangNhap', 'like', '%' . $keyword . '%')
                    ->orWhere('Email', 'like', '%' . $keyword . '%');
            });
        }
if ($status !== null && $status !== '') {
    $users->where('TrangThai', '=', (int)$status); 
}
$users = $users->paginate(5)->withQueryString();
        return view('admin.users.customers', compact('users'));
    }

    // ===================================================
    // CHI TIẾT KHÁCH HÀNG
    // ===================================================
    public function show($id)
    {
        $user = TaiKhoan::where('MaTaiKhoan', $id)->first();

        // Bổ sung thông báo lỗi nếu cố tình truy cập khách hàng không tồn tại
        if (!$user || $user->VaiTro != 'user') {
            return redirect('/admin/customers')
                ->with('error', 'Không tìm thấy thông tin khách hàng này hoặc tài khoản không hợp lệ!');
        }

        return view('admin.users.user-detail', compact('user'));
    }

    // ===================================================
    // KHÓA / MỞ KHÓA KHÁCH HÀNG
    // ===================================================
    public function toggle($id)
    {
        $user = TaiKhoan::where('MaTaiKhoan', $id)->first();

        // Thêm thông báo nếu không tìm thấy tài khoản để xử lý
        if (!$user) {
            return redirect('/admin/customers')
                ->with('error', 'Tài khoản không tồn tại trên hệ thống!');
        }

        if ($user->VaiTro == 'admin') {
            return redirect('/admin/customers')
                ->with('error', 'Không thể thực hiện thao tác khóa trên tài khoản Quản trị viên!');
        }

        // Kiểm tra trạng thái hiện tại trước khi thay đổi để trả về thông báo chính xác
        $isLocking = ($user->TrangThai == 1);

        // Tiến hành đảo ngược trạng thái (1 thành 0, 0 thành 1)
        $user->TrangThai = $isLocking ? 0 : 1;
        $user->save();

        // Tạo chuỗi thông báo động lồng tên khách hàng
        $message = $isLocking 
            ? "Đã khóa tài khoản của khách hàng {$user->HoTen} thành công!" 
            : "Đã mở khóa tài khoản của khách hàng {$user->HoTen} thành công!";

        // Trả về trang danh sách kèm theo thông báo thành công
        return redirect('/admin/customers')->with('success', $message);
    }
}