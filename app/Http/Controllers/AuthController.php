<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;

class AuthController extends Controller
{
    // =========================
    // REGISTER
    // =========================

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([

            'HoTen' =>
                'required|min:3|max:50',

            'TenDangNhap' =>
                'required|min:4|max:20|unique:tai_khoan,TenDangNhap',

            'Email' =>
                'required|email|unique:tai_khoan,Email',

            'SoDienThoai' =>
                'required|regex:/^[0-9]{10,11}$/',

            'MatKhau' => [

                'required',
                'min:6',

                // phải có chữ
                'regex:/[a-zA-Z]/',

                // phải có số
                'regex:/[0-9]/',

                // phải có ký tự đặc biệt
                'regex:/[@$!%*#?&]/'
            ],

            'NhapLaiMatKhau' =>
                'required|same:MatKhau'

        ], [

            'HoTen.required' =>
                'Họ tên không được để trống',

            'HoTen.min' =>
                'Họ tên tối thiểu 3 ký tự',

            'TenDangNhap.required' =>
                'Tên đăng nhập không được để trống',

            'TenDangNhap.unique' =>
                'Tên đăng nhập đã tồn tại',

            'Email.required' =>
                'Email không được để trống',

            'Email.email' =>
                'Email không đúng định dạng',

            'Email.unique' =>
                'Email đã tồn tại',

            'SoDienThoai.required' =>
                'Số điện thoại không được để trống',

            'SoDienThoai.regex' =>
                'Số điện thoại phải từ 10-11 số',

            'MatKhau.required' =>
                'Mật khẩu không được để trống',

            'MatKhau.min' =>
                'Mật khẩu tối thiểu 6 ký tự',

            'MatKhau.regex' =>
                'Mật khẩu phải có chữ, số và ký tự đặc biệt',

            'NhapLaiMatKhau.required' =>
                'Vui lòng nhập lại mật khẩu',

            'NhapLaiMatKhau.same' =>
                'Mật khẩu nhập lại không khớp'
        ]);

        // =========================
        // TẠO MÃ TÀI KHOẢN TỰ ĐỘNG
        // =========================

        $lastUser = TaiKhoan::orderBy(
            'MaTaiKhoan',
            'desc'
        )->first();

        if ($lastUser) {

            $lastNumber = (int) substr(
                $lastUser->MaTaiKhoan,
                2
            );

            $newNumber = $lastNumber + 1;

        } else {

            $newNumber = 1;
        }

        // TK001
        $newMaTaiKhoan =
            'TK' . str_pad(
                $newNumber,
                3,
                '0',
                STR_PAD_LEFT
            );

        // =========================
        // CREATE USER
        // =========================

        TaiKhoan::create([

            'MaTaiKhoan' =>
                $newMaTaiKhoan,

            'HoTen' =>
                $request->HoTen,

            'TenDangNhap' =>
                $request->TenDangNhap,

            'Email' =>
                $request->Email,

            'SoDienThoai' =>
                $request->SoDienThoai,

            'MatKhau' =>
                Hash::make(
                    $request->MatKhau
                ),

            'VaiTro' => 'user',

            'TrangThai' => 1
        ]);

        return redirect('/login')
            ->with(
                'success',
                'Đăng ký thành công'
            );
    }

    // =========================
    // LOGIN
    // =========================

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = TaiKhoan::where(
            'TenDangNhap',
            $request->TenDangNhap
        )->first();

        // không tồn tại user
        if (!$user) {

            return back()->with(
                'error',
                'Sai tài khoản hoặc mật khẩu'
            );
        }

        // kiểm tra mật khẩu
        if (!Hash::check(
            $request->MatKhau,
            $user->MatKhau
        )) {

            return back()->with(
                'error',
                'Sai tài khoản hoặc mật khẩu'
            );
        }

        // kiểm tra trạng thái
        if ($user->TrangThai == 0) {

            return back()->with(
                'error',
                'Tài khoản đã bị khóa'
            );
        }

        // login
        Auth::login($user);

        session()->save();

        // admin
        if ($user->VaiTro == 'admin') {

            return redirect('/admin');
        }

        // user
        return redirect('/');
    }

    // =========================
    // LOGOUT
    // =========================

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

    // =========================
    // PROFILE
    // =========================

    public function showProfile()
    {
        $user = Auth::user();

        return view(
            'profile.profile',
            compact('user')
        );
    }

    public function updateProfile(Request $request)
    {
        $request->validate([

            'HoTen' =>
                'required|min:3|max:50',

            'Email' =>

                'required|email|unique:tai_khoan,Email,'
                . Auth::id()
                . ',MaTaiKhoan',

            'SoDienThoai' =>
                'required|regex:/^[0-9]{10,11}$/',

            'DiaChi' =>
                'required|min:5|max:255'

        ]);

        $user = TaiKhoan::where(
            'MaTaiKhoan',
            Auth::id()
        )->first();

        $user->HoTen =
            $request->HoTen;

        $user->Email =
            $request->Email;

        $user->SoDienThoai =
            $request->SoDienThoai;

        $user->DiaChi =
            $request->DiaChi;

        $user->save();

        return back()->with(
            'success',
            'Cập nhật thành công'
        );
    }

    // =========================
    // CHANGE PASSWORD
    // =========================

    public function showChangePassword()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([

            'MatKhauCu' =>
                'required',

            'MatKhauMoi' => [

                'required',
                'min:6',

                'regex:/[a-zA-Z]/',

                'regex:/[0-9]/',

                'regex:/[@$!%*#?&]/'
            ],

            'NhapLaiMatKhauMoi' =>
                'required|same:MatKhauMoi'

        ]);

        $user = TaiKhoan::where(
            'MaTaiKhoan',
            Auth::id()
        )->first();

        // kiểm tra password cũ
        if (!Hash::check(
            $request->MatKhauCu,
            $user->MatKhau
        )) {

            return back()->with(
                'error',
                'Mật khẩu cũ không đúng'
            );
        }

        // cập nhật password mới
        $user->MatKhau =
            Hash::make(
                $request->MatKhauMoi
            );

        $user->save();

        return back()->with(
            'success',
            'Đổi mật khẩu thành công'
        );
    }

    // =========================
    // FORGOT PASSWORD
    // =========================

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([

            'Email' =>
                'required|email',

            'MatKhauMoi' => [

                'required',
                'min:6',

                'regex:/[a-zA-Z]/',

                'regex:/[0-9]/',

                'regex:/[@$!%*#?&]/'
            ],

            'NhapLaiMatKhau' =>
                'required|same:MatKhauMoi'
        ]);

        // tìm user
        $user = TaiKhoan::where(
            'Email',
            $request->Email
        )->first();

        // không tồn tại email
        if (!$user) {

            return back()->with(
                'error',
                'Email không tồn tại'
            );
        }

        // cập nhật password mới
        $user->MatKhau =
            Hash::make(
                $request->MatKhauMoi
            );

        $user->save();

        return back()->with(
            'success',
            'Đặt lại mật khẩu thành công'
        );
    }

    // =========================
    // ADMIN - LIST USER
    // =========================

    public function listUsers(Request $request)
    {
        $keyword = $request->keyword;

        // chỉ lấy tài khoản user
        $users = TaiKhoan::where(
            'VaiTro',
            'user'
        );

        // tìm kiếm
        if ($keyword) {

            $users->where(function ($query) use ($keyword) {

                $query->where(
                    'MaTaiKhoan',
                    'like',
                    '%' . $keyword . '%'
                )
                ->orWhere(
                    'HoTen',
                    'like',
                    '%' . $keyword . '%'
                )
                ->orWhere(
                    'TenDangNhap',
                    'like',
                    '%' . $keyword . '%'
                )
                ->orWhere(
                    'Email',
                    'like',
                    '%' . $keyword . '%'
                );

            });
        }

        $users = $users->get();

        return view(
            'admin.users.customers',
            compact('users')
        );
    }

    // =========================
    // ADMIN - TOGGLE USER
    // =========================

    public function toggleUser($id)
    {
        $user = TaiKhoan::where(
            'MaTaiKhoan',
            $id
        )->first();

        // không tồn tại
        if (!$user) {

            return redirect('/admin/customers');
        }

        // không cho khóa admin
        if ($user->VaiTro == 'admin') {

            return redirect('/admin/customers')
                ->with(
                    'error',
                    'Không thể khóa admin'
                );
        }

        // đổi trạng thái
        if ($user->TrangThai == 1) {

            $user->TrangThai = 0;

        } else {

            $user->TrangThai = 1;
        }

        $user->save();

        return redirect('/admin/customers');
    }

    // =========================
    // ADMIN - DETAIL USER
    // =========================

    public function showUser($id)
    {
        $user = TaiKhoan::where(
            'MaTaiKhoan',
            $id
        )->first();

        // chỉ xem user
        if (!$user || $user->VaiTro != 'user') {

            return redirect('/admin/customers');
        }

        return view(
            'admin.users.user-detail',
            compact('user')
        );
    }
}