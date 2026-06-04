<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'rating' => [
            'required',
            'integer',
            'between:1,5'
        ],
        'comment' => [
            'required',
            'string',
            'min:5',
            'max:255'
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
            'rating.required' => 'Vui lòng chọn số sao.',
            'rating.between' => 'Số sao phải từ 1 đến 5.',
            'comment.required' => 'Vui lòng nhập nhận xét.',
            'comment.min' => 'Nhận xét phải có ít nhất 5 ký tự.',
            'comment.max' => 'Nhận xét tối đa 255 ký tự.',
            'product_id.exists' => 'Sản phẩm không tồn tại.',
            'order_id.exists' => 'Đơn hàng không tồn tại.'
        ]);
        if(trim($request->comment) == '')
        {
            return back()->withErrors(['comment' => 'Nhận xét không hợp lệ.'])->withInput();
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
            'rating' => [
            'required',
            'integer',
            'between:1,5'
        ],
        'comment' => [
            'required',
            'string',
            'min:5',
            'max:255'
        ]
        ],[
            'rating.required' => 'Vui lòng chọn số sao.',
            'rating.between' => 'Số sao phải từ 1 đến 5.',
            'comment.required' => 'Vui lòng nhập nhận xét.',
            'comment.min' => 'Nhận xét phải có ít nhất 5 ký tự.',
            'comment.max' => 'Nhận xét tối đa 255 ký tự.'
        ]);
        if(trim($request->comment) == '')
        {
            return back()->withErrors(['comment' => 'Nhận xét không hợp lệ.'])->withInput();
        }
        $review = DanhGia::findOrFail($id);
        $review->update(['XepHang' => $request->rating,'BinhLuan' => $request->comment
        ]);
        return redirect()->route('order.lichSu') ->with('success','Đã sửa đánh giá');
    }

    public function destroy($id)
    {
        DanhGia::where('MaDanhGia', $id)->delete();
        return redirect()->route('order.lichSu')->with('success','Đã xóa đánh giá');
    }
}