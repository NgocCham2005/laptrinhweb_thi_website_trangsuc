<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Nếu đã đăng nhập
        if (Auth::check()) {
            // 2. Kiểm tra quyền Admin (Sửa số 1 thành đúng logic role bên bạn nếu nhóm dùng chữ 'admin')
            if (Auth::user()->role == 1) { 
                return $next($request); // Đúng quyền thì cho qua cửa
            }
            // Đã đăng nhập nhưng là khách thường -> Đá về trang chủ kèm thông báo
            return redirect('/')->with('error', 'Bạn không có quyền truy cập vào khu vực Quản trị!');
        }

        // 3. Chưa đăng nhập mà tự sửa link trên URL -> Đá văng ra trang đăng nhập
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập tài khoản Admin để tiếp tục!');
    }
}