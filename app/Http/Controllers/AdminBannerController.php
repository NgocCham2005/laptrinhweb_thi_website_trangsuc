<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class AdminBannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest('MaBanner')->paginate(3);
        return view('admin.banners.banners', compact('banners'));
    }

    private function taoMaBanner()
    {
        $bannerCuoi = Banner::orderBy('MaBanner', 'desc')->first();
        if ($bannerCuoi) {
            $soCuoi = (int) substr($bannerCuoi->MaBanner, 2);
            return 'BN' . str_pad($soCuoi + 1, 2, '0', STR_PAD_LEFT);
        }
        return 'BN01';
    }

    public function create()
    {
        $maBanner = $this->taoMaBanner();
        return view('admin.banners.add-banner', compact('maBanner'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_banner' => [
                'required',
                'string',
                'min:3',
                'max:100',
                'regex:/.*\S.*/'
            ],
            'hinh_anh' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
            ]
        ], [
            'ten_banner.required' => 'Vui lòng nhập tên banner.',
            'ten_banner.min' => 'Tên banner phải có ít nhất 3 ký tự.',
            'ten_banner.max' => 'Tên banner tối đa 100 ký tự.',
            'ten_banner.regex' => 'Tên banner không được chỉ chứa khoảng trắng.',

            'hinh_anh.required' => 'Vui lòng chọn ảnh.',
            'hinh_anh.image' => 'File phải là hình ảnh.',
            'hinh_anh.mimes' => 'Ảnh chỉ được là jpg, jpeg, png hoặc webp.'
        ]);
        $maBanner = $this->taoMaBanner();
        $imageName = time() . '.' .
            $request->file('hinh_anh')->getClientOriginalExtension();

        $request->file('hinh_anh')->move(
            public_path('images/banners'),
            $imageName
        );
        Banner::create([
            'MaBanner' => $maBanner,
            'TenBanner' => trim($request->ten_banner),
            'HinhAnh' => $imageName,
            'TrangThai' => 1
        ]);
        return redirect()->route('admin.banners')->with('success', 'Thêm banner thành công');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit-banner', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_banner' => [
                'required',
                'string',
                'min:3',
                'max:100',
                'regex:/.*\S.*/'
            ],
            'trang_thai' => [
                'required',
                'in:0,1'
            ],
            'hinh_anh' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ]
        ], [
            'ten_banner.required' => 'Vui lòng nhập tên banner.',
            'ten_banner.min' => 'Tên banner phải có ít nhất 3 ký tự.',
            'ten_banner.max' => 'Tên banner tối đa 100 ký tự.',
            'ten_banner.regex' => 'Tên banner không được chỉ chứa khoảng trắng.',

            'trang_thai.required' => 'Vui lòng chọn trạng thái.',
            'trang_thai.in' => 'Trạng thái không hợp lệ.',

            'hinh_anh.image' => 'File phải là hình ảnh.',
            'hinh_anh.mimes' => 'Ảnh chỉ được là jpg, jpeg, png hoặc webp.',
            'hinh_anh.max' => 'Ảnh tối đa 2MB.'
        ]);
        $banner = Banner::findOrFail($id);
        $banner->TenBanner = trim($request->ten_banner);
        $banner->TrangThai = $request->trang_thai;
        if ($request->hasFile('hinh_anh')) {
            $oldImage = public_path(
                'images/banners/' . $banner->HinhAnh
            );
            if (
                !empty($banner->HinhAnh) &&
                file_exists($oldImage)
            ) {
                unlink($oldImage);
            }
            $imageName = time() . '.' .
                $request->file('hinh_anh')
                ->getClientOriginalExtension();
            $request->file('hinh_anh')->move(
                public_path('images/banners'),
                $imageName
            );
            $banner->HinhAnh = $imageName;
        }
        $banner->save();
        return redirect()->route('admin.banners')->with('success', 'Cập nhật banner thành công');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $imagePath = public_path(
            'images/banners/' . $banner->HinhAnh
        );
        if (
            !empty($banner->HinhAnh) &&
            file_exists($imagePath)
        ) {
            unlink($imagePath);
        }
        $banner->delete();
        return redirect()->route('admin.banners')->with('success', 'Xóa banner thành công');
    }
}