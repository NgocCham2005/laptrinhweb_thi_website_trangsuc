<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::paginate(3);
        return view('admin.banners.banners', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.add-banner');
    }

    public function store(Request $request)
    {
        $imageName = time() . '.' . $request->hinh_anh->extension();
        $request->hinh_anh->move(public_path('images/banners'),$imageName);
        Banner::create([
            'MaBanner'  => $request->ma_banner,
            'TenBanner' => $request->ten_banner,
            'HinhAnh'   => $imageName,
            'TrangThai' => 1
        ]);
        return redirect()
                ->route('admin.banners')
                ->with('success', 'Thêm banner thành công');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit-banner', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        // XỬ LÝ ẢNH MỚI (nếu có)
        if($request->hasFile('hinh_anh'))
        {
            $imageName = time() . '.' .
                         $request->hinh_anh->extension();
            $request->hinh_anh->move(
                public_path('images/banners'),
                $imageName
            );
            $banner->HinhAnh = $imageName;
        }

        // UPDATE DỮ LIỆU
        $banner->TenBanner = $request->ten_banner;
        $banner->TrangThai = $request->trang_thai;
        $banner->save();
        return redirect()
                ->route('admin.banners')
                ->with('success', 'Cập nhật banner thành công');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        // XỬ LÝ XÓA ẢNH
        $imagePath = public_path(
            'images/banners/' . $banner->HinhAnh
        );
        if(file_exists($imagePath))
        {
            unlink($imagePath);
        }

        // XỬ LÝ XÓA DB
        $banner->delete();
        return redirect()
                ->route('admin.banners')
                ->with('success', 'Xóa banner thành công');
    }
}