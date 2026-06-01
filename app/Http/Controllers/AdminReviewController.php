<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DanhGia;
use App\Models\ChiTietPhanHoi;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = DanhGia::with(['product','replies','user'])->latest('NgayTao')->paginate(2);
        return view('admin.reviews',compact('reviews'));
    }

    public function hide($id)
    {
        $review = DanhGia::findOrFail($id);
        $review->update(['TrangThai' => 0]);
        return redirect()->back()->with('success','Đã ẩn đánh giá');
    }

    public function display($id)
    {
        $review = DanhGia::findOrFail($id);
        $review->update(['TrangThai' => 1]);
        return redirect()->back()->with('success','Đã hiển thị đánh giá');
    }

    public function destroy($id)
    {
        $review = DanhGia::findOrFail($id);
        ChiTietPhanHoi::where('MaDanhGia', $id)->delete();
        $review->delete();
        return redirect()->back()->with('success','Đã xóa đánh giá');
    }

    public function reply(Request $request, $id)
    {
        $request->validate(['reply' => 'required|max:255']);
        $reply = ChiTietPhanHoi::where('MaDanhGia',$id)->first();
        if ($reply)
        {
            ChiTietPhanHoi::where('MaDanhGia', $id)
            ->update(['NoiDungPhanHoi' => $request->reply,'NgayPhanHoi' => now()]);
            return redirect()->back()->with('success', 'Đã cập nhật phản hồi');
        }
        ChiTietPhanHoi::create([
            'MaDanhGia' => $id,
            'MaTaiKhoan' => 'TK005',
            'NoiDungPhanHoi' => $request->reply,
            'NgayPhanHoi' => now()
        ]);
        return redirect()->back()->with('success', 'Đã phản hồi đánh giá');
    }
}