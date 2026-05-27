<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhGia;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        DanhGia::create([
            'MaDanhGia' => 'DG' . rand(1000,9999),
            'BinhLuan' => $request->comment,
            'XepHang' => $request->rating,
            'TrangThai' => 1,
            'MaTaiKhoan' => 'TK001',
            'MaSanPham' => $request->product_id,
            'MaDonHang' => 'DH001'
        ]);
        return back();
    }
}
