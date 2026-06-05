<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;

class AuthController extends Controller
{
    // ==========================================
    // REGISTER (ĐĂNG KÝ TÀI KHOẢN)
    // ==========================================

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'HoTen' => 'required|min:3|max:50',
            'TenDangNhap' => 'required|min:4|max:20|unique:tai_khoan,TenDangNhap',
            'Email' => 'required|email|unique:tai_khoan,Email',
            'SoDienThoai' => 'required|regex:/^[0-9]{10,11}$/',
            'MatKhau' => [
                'required',
                'min:6',
                'regex:/[a-zA-Z]/', // Phải có chữ
                'regex:/[0-9]/',    // Phải có số
                'regex:/[@$!%*#?&]/' // Phải có ký tự đặc biệt
            ],
            'NhapLaiMatKhau' => 'required|same:MatKhau'
        ], [
            'HoTen.required' => 'Họ tên không được để trống',
            'HoTen.min' => 'Họ tên tối thiểu 3 ký tự',
            'HoTen.max' => 'Họ tên tối đa 50 ký tự',
            'TenDangNhap.required' => 'Tên đăng nhập không được để trống',
            'TenDangNhap.min' => 'Tên đăng nhập tối thiểu 4 ký tự',
            'TenDangNhap.max' => 'Tên đăng nhập tối đa 20 ký tự',
            'TenDangNhap.unique' => 'Tên đăng nhập đã tồn tại',
            'Email.required' => 'Email không được để trống',
            'Email.email' => 'Email không đúng định dạng',
            'Email.unique' => 'Email đã tồn tại',
            'SoDienThoai.required' => 'Số điện thoại không được để trống',
            'SoDienThoai.regex' => 'Số điện thoại phải từ 10-11 số',
            'MatKhau.required' => 'Mật khẩu không được để trống',
            'MatKhau.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'MatKhau.regex' => 'Mật khẩu phải có chữ, số và ký tự đặc biệt (@$!%*#?&)',
            'NhapLaiMatKhau.required' => 'Vui lòng nhập lại mật khẩu',
            'NhapLaiMatKhau.same' => 'Mật khẩu nhập lại không khớp'
        ]);

        // TỰ ĐỘNG TẠO MÃ TÀI KHOẢN (TK001, TK002,...)
        $lastUser = TaiKhoan::orderBy('MaTaiKhoan', 'desc')->first();
        if ($lastUser) {
            $lastNumber = (int) substr($lastUser->MaTaiKhoan, 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $newMaTaiKhoan = 'TK' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // LƯU VÀO DATABASE
        TaiKhoan::create([
            'MaTaiKhoan' => $newMaTaiKhoan,
            'HoTen' => $request->HoTen,
            'TenDangNhap' => $request->TenDangNhap,
            'Email' => $request->Email,
            'SoDienThoai' => $request->SoDienThoai,
            'MatKhau' => Hash::make($request->MatKhau),
            'VaiTro' => 'user',
            'TrangThai' => 1
        ]);

        return redirect('/login')->with('success', 'Đăng ký thành công');
    }

    // ==========================================
    // LOGIN (ĐĂNG NHẬP HỆ THỐNG)
    // ==========================================

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = TaiKhoan::where('TenDangNhap', $request->TenDangNhap)->first();

    if (!$user) {
        return back()->with('error', 'Tên đăng nhập không tồn tại');
    }

    if (!Hash::check($request->MatKhau, $user->MatKhau)) {
        return back()->with('error', 'Mật khẩu không đúng');
    }

    if ($user->TrangThai == 0) {
        return back()->with('error', 'Tài khoản đã bị khóa');
    }

    Auth::login($user);
    session()->regenerate();
   

if (trim($user->VaiTro) === 'admin') {
    return redirect('/admin');
}
    return redirect('/'); // Sau khi đăng nhập, đẩy thẳng người dùng về trang cá nhân để test
    }

    // ==========================================
    // LOGOUT (ĐĂNG XUẤT TÀI KHOẢN)
    // ==========================================

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // ==========================================
    // PROFILE (QUẢN LÝ THÔNG TIN CÁ NHÂN)
    // ==========================================

    public function showProfile()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user')); // Trỏ đúng vào thư mục view profile
    }

    public function updateProfile(Request $request)
    {
        $userKey = Auth::user()->MaTaiKhoan; // Lấy chuỗi khóa chính (Ví dụ: TK001)

        $request->validate([
            'HoTen' => 'required|min:3|max:50',
            'Email' => 'required|email|unique:tai_khoan,Email,' . $userKey . ',MaTaiKhoan',
            'SoDienThoai' => 'required|regex:/^[0-9]{10,11}$/',
            'DiaChi' => 'required|min:5|max:255'
        ], [
            'HoTen.required' => 'Họ tên không được để trống',
            'HoTen.min' => 'Họ tên tối thiểu 3 ký tự',
            'HoTen.max' => 'Họ tên tối đa 50 ký tự',
            'Email.required' => 'Email không được để trống',
            'Email.email' => 'Email không đúng định dạng',
            'Email.unique' => 'Email đã được sử dụng bởi tài khoản khác',
            'SoDienThoai.required' => 'Số điện thoại không được để trống',
            'SoDienThoai.regex' => 'Số điện thoại phải từ 10-11 số',
            'DiaChi.required' => 'Địa chỉ không được để trống',
            'DiaChi.min' => 'Địa chỉ tối thiểu 5 ký tự',
            'DiaChi.max' => 'Địa chỉ tối đa 255 ký tự'
        ]);

        $user = TaiKhoan::where('MaTaiKhoan', $userKey)->first();
        $user->HoTen = $request->HoTen;
        $user->Email = $request->Email;
        $user->SoDienThoai = $request->SoDienThoai;
        $user->DiaChi = $request->DiaChi;
        $user->save();

        return redirect('/profile')->with('success', 'Cập nhật thông tin thành công');
    }

    // ==========================================
    // CHANGE PASSWORD (SỬA ĐỔI MẬT KHẨU)
    // ==========================================

    public function showChangePassword()
    {
        // Đã SỬA: Chuyển từ 'auth.change-password' sang 'profile.change-password' cho đúng thư mục mới
        return view('auth.change-password'); 
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'MatKhauCu' => 'required',
            'MatKhauMoi' => [
                'required',
                'min:6',
                'regex:/[a-zA-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],
            'NhapLaiMatKhauMoi' => 'required|same:MatKhauMoi'
        ], [
            'MatKhauCu.required' => 'Mật khẩu cũ không được để trống',
            'MatKhauMoi.required' => 'Mật khẩu mới không được để trống',
            'MatKhauMoi.min' => 'Mật khẩu mới tối thiểu 6 ký tự',
            'MatKhauMoi.regex' => 'Mật khẩu mới phải có chữ, số và ký tự đặc biệt (@$!%*#?&)',
            'NhapLaiMatKhauMoi.required' => 'Vui lòng nhập lại mật khẩu mới',
            'NhapLaiMatKhauMoi.same' => 'Mật khẩu nhập lại không khớp'
        ]);

        $userKey = Auth::user()->MaTaiKhoan;
        $user = TaiKhoan::where('MaTaiKhoan', $userKey)->first();

        // Kiểm tra password cũ có khớp không
        if (!Hash::check($request->MatKhauCu, $user->MatKhau)) {
    return back()->withErrors(['MatKhauCu' => 'Mật khẩu cũ không đúng'])->withInput();
        }

        // Cập nhật password mới mã hóa bằng Hash
        $user->MatKhau = Hash::make($request->MatKhauMoi);
        $user->save();

        // Chuyển hướng về lại trang profile kèm thông báo thành công chữ màu xanh
        return redirect('/profile')->with('success', 'Đổi mật khẩu thành công');
    }

    // ==========================================
    // FORGOT PASSWORD (QUÊN MẬT KHẨU)
    // ==========================================

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'Email' => 'required|email',
            'MatKhauMoi' => [
                'required',
                'min:6',
                'regex:/[a-zA-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],
            'NhapLaiMatKhau' => 'required|same:MatKhauMoi'
        ], [
            'Email.required' => 'Email không được để trống',
            'Email.email' => 'Email không đúng định dạng',
            'MatKhauMoi.required' => 'Mật khẩu mới không được để trống',
            'MatKhauMoi.min' => 'Mật khẩu mới tối thiểu 6 ký tự',
            'MatKhauMoi.regex' => 'Mật khẩu mới phải có chữ, số và ký tự đặc biệt (@$!%*#?&)',
            'NhapLaiMatKhau.required' => 'Vui lòng nhập lại mật khẩu',
            'NhapLaiMatKhau.same' => 'Mật khẩu nhập lại không khớp'
        ]);

        $user = TaiKhoan::where('Email', $request->Email)->first();

        if (!$user) {
            return back()->with('error', 'Email không tồn tại trong hệ thống');
        }

        $user->MatKhau = Hash::make($request->MatKhauMoi);
        $user->save();

        return back()->with('success', 'Đặt lại mật khẩu thành công');
    }
}