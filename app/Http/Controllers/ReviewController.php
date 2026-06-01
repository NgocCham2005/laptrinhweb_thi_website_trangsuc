<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhGia;
use App\Models\SanPham;

class ReviewController extends Controller
{
    public function create($product, $order)
    {
        $sanPham = SanPham::findOrFail($product);

        $review = DanhGia::where('MaSanPham', $product)
                    ->where('MaDonHang', $order)
                    ->where( 'MaTaiKhoan','TK014' ) // giả sử tài khoản đang đăng nhập là TK014
                    ->first();
        return view('order.review',compact( 'sanPham','order','review' ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|max:255',
            'product_id' => 'required',
            'order_id' => 'required'
        ]);
        $exists = DanhGia::where('MaSanPham', $request->product_id)
                    ->where('MaDonHang', $request->order_id )
                    ->where('MaTaiKhoan', 'TK014') // giả sử tài khoản đang đăng nhập là TK014
                    ->exists();
        
                    if($exists)
        {
            return back()->with('error','Bạn đã đánh giá sản phẩm này rồi');
        }

        $lastReview = DanhGia::orderBy('MaDanhGia','desc')->first();
        
        if($lastReview)
        {
            $soMoi = (int) substr($lastReview->MaDanhGia,2,4) + 1;
        }
        else
        {
            $soMoi = 1;
        }

        $maDanhGia = 'DG' .str_pad( $soMoi, 4, '0', STR_PAD_LEFT);

        DanhGia::create([
            'MaDanhGia' => $maDanhGia,
            'BinhLuan' => $request->comment,
            'XepHang' => $request->rating,
            'TrangThai' => 1,
            'MaTaiKhoan' => 'TK014',
            'MaSanPham' => $request->product_id,
            'MaDonHang' => $request->order_id
        ]);

        return redirect()->route('order.lichSu')->with( 'success','Đánh giá thành công' );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|max:255'
        ]);

        $review = DanhGia::findOrFail($id);

        $review->update([
            'XepHang' => $request->rating,
            'BinhLuan' => $request->comment

        ]);

        return redirect()->route('order.lichSu') ->with('success','Đã sửa đánh giá');
    }

    public function destroy($id)
    {
        DanhGia::where(
            'MaDanhGia',
            $id
        )->delete();
        return redirect()->route('order.lichSu')->with('success','Đã xóa đánh giá');
    }
}