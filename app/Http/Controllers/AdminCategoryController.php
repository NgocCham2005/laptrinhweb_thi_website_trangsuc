<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMucSP;

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
        DanhMucSP::create([
            'MaDanhMuc'  => $request->ma_danhmuc,
            'TenDanhMuc' => $request->ten_danhmuc,
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
        
        $category->update([
            'TenDanhMuc' => $request->ten_danhmuc,
            'TrangThai'  => $request->trang_thai,
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
            $category->delete();
            
            return redirect()->route('admin.categories')->with('success', 'Xóa danh mục thành công!');
        }
    }
}