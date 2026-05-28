<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DanhGia;
use App\Models\ChiTietPhanHoi;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = DanhGia::with(['product','replies'])->latest('NgayTao')->paginate(3);
        return view('admin.reviews',compact('reviews'));
    }

    public function hide($id)
    {
        $review = DanhGia::findOrFail($id);
        $review->TrangThai = 0;
        $review->save();
        return redirect()->back()->with('success','Đã ẩn đánh giá');
    }

    public function display($id)
    {
        $review = DanhGia::findOrFail($id);
        $review->TrangThai = 1;
        $review->save();
        return redirect()->back()->with('success','Đã hiển thị đánh giá');
    }

    public function destroy($id)
    {
        $review = DanhGia::findOrFail($id);
        ChiTietPhanHoi::where(
            'MaDanhGia',
            $id
        )->delete();
        $review->delete();
        return redirect()->back()->with('success','Đã xóa đánh giá');
    }

    public function reply(Request $request,$id)
    {
        $request->validate(['reply' => 'required|max:255']);
        // TẠM THỜI FAKE TÀI KHOẢN PHẢN HỒI
        ChiTietPhanHoi::create(['MaDanhGia' => $id,'MaTaiKhoan' => 'TK005','NoiDungPhanHoi' => $request->reply]);
        return redirect()->back()->with('success','Đã phản hồi đánh giá');
    }
}