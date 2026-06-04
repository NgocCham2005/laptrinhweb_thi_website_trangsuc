<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhGia;
use App\Models\ChiTietPhanHoi;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = DanhGia::with(['product','replies','user'])->latest('NgayTao')->paginate(3);
        return view('admin.reviews',compact('reviews'));
    }

    public function hide($id)
    {
        $review = DanhGia::find($id);
        if(!$review)
        {
            return back()->with('error','Đánh giá không tồn tại.');
        }
        $review->update(['TrangThai' => 0]);
        return back()->with('success','Đã ẩn đánh giá');
    }

    public function display($id)
    {
        $review = DanhGia::find($id);
        if(!$review)
        {
            return back()->with('error','Đánh giá không tồn tại.');
        }
        $review->update(['TrangThai' => 1]);
        return back()->with('success','Đã hiển thị đánh giá');
    }

    public function destroy($id)
    {
        $review = DanhGia::find($id);
        if(!$review)
        {
            return back()->with('error','Đánh giá không tồn tại.');
        }
        ChiTietPhanHoi::where('MaDanhGia',$id)->delete();
        $review->delete();
        return back()->with('success','Đã xóa đánh giá');
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => [
            'required',
            'string',
            'min:2',
            'max:255']
        ],[
            'reply.required' => 'Vui lòng nhập nội dung phản hồi.',
            'reply.min'      => 'Phản hồi phải có ít nhất 2 ký tự.',
            'reply.max'      => 'Phản hồi không được vượt quá 255 ký tự.'
        ]);
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