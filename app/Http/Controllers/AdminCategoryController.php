<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMucSP;
use App\Models\SanPham;
use Illuminate\Support\Facades\File;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = DanhMucSP::withCount('sanPhams')->paginate(3);
        //$categories = DanhMucSP::orderBy('MaDanhMuc', 'desc')->paginate(3); 
        
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $lastCategory = DanhMucSP::orderBy('MaDanhMuc', 'desc')->first();

        $nextNumber = 1;

        if ($lastCategory) {
            $lastId = $lastCategory->MaDanhMuc;
                        $currentNumber = (int) substr($lastId, 2); 
            
            $nextNumber = $currentNumber + 1;
        }
        $nextMaDanhMuc = 'DM' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
        return view('admin.categories.create', compact('nextMaDanhMuc'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'ten_danhmuc'      => 'required|unique:danh_muc,TenDanhMuc|min:2|max:100',
        'hinh_anh_danhmuc' => 'required'
        ], [
        'ten_danhmuc.required'        => 'Vui lòng nhập tên danh mục sản phẩm.',
        'ten_danhmuc.unique'          => 'Tên danh mục đã tồn tại trong hệ thống',
        'ten_danhmuc.min'             => 'Tên danh mục phải có ít nhất 2 ký tự.',
        'ten_danhmuc.max'             => 'Tên danh mục tối đa 100 ký tự.',
        'hinh_anh_danhmuc.required'   => 'Vui lòng chọn ảnh đại diện cho danh mục sản phẩm.',
        'hinh_anh_danhmuc.image'      => 'File tải lên phải là hình ảnh.',
        'hinh_anh_danhmuc.mimes'      => 'Ảnh danh mục chỉ chấp nhận định dạng: jpeg, png, jpg, gif, svg, webp.',
        'hinh_anh_danhmuc.max'        => 'Dung lượng ảnh danh mục tối đa là 2MB.'
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
        $products = SanPham::where('MaDanhMuc', $category->MaDanhMuc)->get();
        if ($request->trang_thai == 0 || $request->trang_thai == '0') {
        $products = SanPham::where('MaDanhMuc', $category->MaDanhMuc)->get();
        
            foreach ($products as $product) {
                $product->TrangThai = 0;
                $product->save();
            }
        }else{
            foreach ($products as $product) {
            $product->TrangThai = 1;
            $product->save();
        }
        }
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
            $products = SanPham::where('MaDanhMuc', $id)->get();
    
            foreach ($products as $product) {
                $product->TrangThai = 0;
                $product->save();
            }
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