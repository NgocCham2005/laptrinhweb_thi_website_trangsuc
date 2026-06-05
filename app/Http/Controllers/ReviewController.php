<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\DanhGia;
use App\Models\SanPham;

class ReviewController extends Controller
{
    private function layMaTaiKhoan() {
        return Auth::user()->MaTaiKhoan;
    }

    public function create($product, $order)
    {
        $sanPham = SanPham::findOrFail($product);

        $review = DanhGia::where('MaSanPham', $product)
                    ->where('MaDonHang', $order)
                    ->where( 'MaTaiKhoan', $this->layMaTaiKhoan() )
                    ->first();
        return view('order.review',compact( 'sanPham','order','review' ));
    }

    public function store(Request $request)
    {
        $request->validate([
        'comment' => [
            'required',
            'string',
            'min:30'
        ],
        'product_id' => [
            'required',
            'exists:san_pham,MaSanPham'
        ],
        'order_id' => [
            'required',
            'exists:don_hang,MaDonHang'
        ]
        ],[
            'comment.required' => 'Vui lòng nhập bình luận.',
            'comment.min' => 'Bình luận phải có ít nhất 30 ký tự.',
            'product_id.exists' => 'Sản phẩm không tồn tại.',
            'order_id.exists' => 'Đơn hàng không tồn tại.'
        ]);
        if(trim($request->comment) == '')
        {
            return back()->withErrors(['comment' => 'Bình luận không hợp lệ.'])->withInput();
        }
        $exists = DanhGia::where('MaSanPham', $request->product_id)
                    ->where('MaDonHang', $request->order_id )
                    ->where('MaTaiKhoan', $this->layMaTaiKhoan())
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
            'MaTaiKhoan' => $this->layMaTaiKhoan(),
            'MaSanPham' => $request->product_id,
            'MaDonHang' => $request->order_id
        ]);
        return redirect()->route('order.lichSu')->with( 'success','Đánh giá thành công' );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'comment' => [
            'required',
            'string',
            'min:30',
        ]
        ],[
            'comment.required' => 'Vui lòng nhập bình luận.',
            'comment.min' => 'Bình luận phải có ít nhất 30 ký tự.'
        ]);
        if(trim($request->comment) == '')
        {
            return back()->withErrors(['comment' => 'Bình luận không hợp lệ.'])->withInput();
        }
        $review = DanhGia::findOrFail($id);
        $review->update(['XepHang' => $request->rating,'BinhLuan' => $request->comment
        ]);
        return redirect()->route('order.lichSu') ->with('success','Đã sửa đánh giá');
    }
}