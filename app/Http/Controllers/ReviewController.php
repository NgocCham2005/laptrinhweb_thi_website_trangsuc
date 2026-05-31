<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhGia;
use App\Models\SanPham;

class ReviewController extends Controller
{
    /*Hiển thị form đánh giá*/
    public function create($product, $order)
    {
        $sanPham = SanPham::findOrFail($product);

        return view('order.review',compact('sanPham','order'));
    }

    /*Lưu đánh giá*/
    public function store(Request $request)
    {
        $request->validate([
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required|max:255',
            'product_id' => 'required',
            'order_id'   => 'required'
        ]);
        // Kiểm tra đã đánh giá chưa
        $exists = DanhGia::where('MaDonHang',$request->order_id)
        ->where('MaSanPham',$request->product_id)->exists();
        if ($exists) {
            return back()->with(
                'error',
                'Bạn đã đánh giá sản phẩm này rồi!'
            );
        }

        // Tạo mã đánh giá
        do {
            $maDanhGia = 'DG' . rand(1000, 9999);
        } while (
            DanhGia::where(
                'MaDanhGia',
                $maDanhGia
            )->exists()
        );

        DanhGia::create([
            'MaDanhGia' => $maDanhGia,
            'BinhLuan' => $request->comment,
            'XepHang' => $request->rating,
            'TrangThai' => 1,
            // TẠM THỜI
            'MaTaiKhoan' => 'TK014',
            //'MaTaiKhoan' => auth()->user()->MaTaiKhoan,
            'MaSanPham' => $request->product_id,
            'MaDonHang' => $request->order_id

        ]);

        return redirect()->route('order.myOrders')->with('success','Đánh giá thành công!');
    }
}