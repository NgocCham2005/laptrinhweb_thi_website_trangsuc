<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMucSP;
use Illuminate\Support\Facades\File;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = DanhMucSP::paginate(5); 
        
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ma_danhmuc' => 'required',
            'ten_danhmuc' => 'required',
        'hinh_anh_danhmuc' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ], [
        'hinh_anh_danhmuc.required' => 'Vui lòng chọn ảnh đại diện cho danh mục sản phẩm!'
        ]);

        $fileName = null;
            if ($request->hasFile('hinh_anh_danhmuc')) {
                $file = $request->file('hinh_anh_danhmuc');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/categories'), $fileName);
            }
        DanhMucSP::create([
            'MaDanhMuc'  => $request->ma_danhmuc,
            'TenDanhMuc' => $request->ten_danhmuc,
            'HinhAnh'    => $fileName,
            'TrangThai'  => 1
        ]);

        return redirect()->route('admin.categories')->with('success', 'Thêm danh mục mới thành công!');
    }

    public function edit($id)
    {
        $category = DanhMucSP::findOrFail($id);
        
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = DanhMucSP::findOrFail($id);
        $hasOldImage = !empty($category->HinhAnh);
        $request->validate([
            'ten_danhmuc' => 'required',
        'hinh_anh_danhmuc' => ($hasOldImage ? 'nullable' : 'required') . '|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
            ], [
                'hinh_anh_danhmuc.required' => 'Danh mục bắt buộc phải có ảnh đại diện, vui lòng không bỏ trống!'
            ]);
        $fileName = $category->HinhAnh;
if ($request->hasFile('hinh_anh_danhmuc')) {
        if ($fileName && \File::exists(public_path('images/categories/' . $fileName))) {
            \File::delete(public_path('images/categories/' . $fileName));
        }

        $file = $request->file('hinh_anh_danhmuc');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/categories'), $fileName);
    }
        $category->update([
            'TenDanhMuc' => $request->ten_danhmuc,
            'TrangThai'  => $request->trang_thai,
            'HinhAnh'    => $fileName,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Cập nhật danh mục thành công!');
    }

    public function destroy($id)
    {
        $category = DanhMucSP::findOrFail($id);

        $hasProducts = \DB::table('san_pham')
            ->where('MaDanhMuc', $id)
            ->exists();

        if ($hasProducts) {
            $category->update([
                'TrangThai' => 0
            ]);
            
            return redirect()->route('admin.categories')->with('success', 'Danh mục này đang chứa sản phẩm nên hệ thống đã tự động chuyển sang trạng thái ẨN!');
        } else {
            $oldImage = $category->HinhAnh; 
            if ($oldImage && File::exists(public_path('images/categories/' . $oldImage))) {
                File::delete(public_path('images/categories/' . $oldImage));
            }
            $category->delete();
            
            return redirect()->route('admin.categories')->with('success', 'Xóa danh mục thành công!');
        }
    }
}