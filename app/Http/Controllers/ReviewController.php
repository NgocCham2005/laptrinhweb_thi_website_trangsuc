<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DanhGia;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'product_id' => 'required'
        ]);

        DanhGia::create([
            'MaDanhGia' => 'DG' . rand(1000,9999),
            'BinhLuan' => $request->comment,
            'XepHang' => $request->rating,
            'TrangThai'=> 1,

            // TẠM THỜI FAKE TÀI KHOẢN ĐÁNH GIÁ
            'MaTaiKhoan'=> 'TK001',
            'MaSanPham'=> $request->product_id,
            'MaDonHang'=> 'DH0010'
        ]);
        return back()->with('success','Đánh giá đã được gửi');
    }
}
