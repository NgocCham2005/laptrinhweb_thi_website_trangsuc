<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMucSP;
use App\Models\HinhAnhSP;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = SanPham::with(['category','images'])->paginate(5);
        foreach ($products as $product) {
        $product->first_image = \DB::table('hinh_anh_sp')
            ->where('MaSanPham', $product->MaSanPham)
            ->value('DuongDan'); 
        }
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = DanhMucSP::where('TrangThai', 1)->get();
        return view('admin.products.add-product', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'ma_sanpham'     => 'required|unique:san_pham,MaSanPham', // Bắt buộc nhập và không trùng mã cũ
        'ten_sanpham'    => 'required',
        'ma_danhmuc'     => 'required',
        'gia_ban'        => 'required|numeric|min:0',
        'so_luong_ton'   => 'required|integer|min:0',
        'hinh_anh_chinh' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Bắt buộc phải chọn ảnh 1
    ], [
        // Viết lại câu thông báo lỗi bằng tiếng Việt để popup hiện lên thân thiện
        'ma_sanpham.required'     => 'Mã sản phẩm không được bỏ trống.',
        'ma_sanpham.unique'       => 'Mã sản phẩm này đã tồn tại trong hệ thống.',
        'ten_sanpham.required'    => 'Tên sản phẩm không được bỏ trống.',
        'ma_danhmuc.required'     => 'Vui lòng chọn danh mục sản phẩm.',
        'gia_ban.required'        => 'Giá bán không được bỏ trống.',
        'gia_ban.numeric'         => 'Giá bán phải là số hợp lệ.',
        'so_luong_ton.required'   => 'Số lượng tồn kho không được bỏ trống.',
        'hinh_anh_chinh.required' => 'Bạn bắt buộc phải tải lên ảnh đại diện ở Ô số 1.',
        'hinh_anh_chinh.image'    => 'Cần tải lên ít nhất 1 ảnh.',
    ]);

    $product = SanPham::create([
        'MaSanPham'  => $request->ma_sanpham,
        'TenSanPham' => $request->ten_sanpham,
        'MaDanhMuc'  => $request->ma_danhmuc,
        'GiaBan'     => $request->gia_ban,
        'SoLuongTon' => $request->so_luong_ton,
        'ChatLieu'   => $request->chat_lieu,
        'MoTa'       => $request->mo_ta,
        'TrangThai'  => 1
    ]);

    if ($request->hasFile('hinh_anh_chinh')) {
        $file = $request->file('hinh_anh_chinh');
        if ($file->isValid()) {
            $imageName = time() . '_main.' . $file->extension();
            $file->move(public_path('images/products'), $imageName);

            // Bắt buộc phải truyền MaHinhAnh tự sinh ở đây:
            \DB::table('hinh_anh_sp')->insert([
                'MaHinhAnh' => 'HA' . \Illuminate\Support\Str::random(5), 
                'MaSanPham' => $product->MaSanPham,
                'DuongDan'  => $imageName
            ]);
        }
    }
    if ($request->hasFile('hinh_anh_phu')) {
        foreach ($request->file('hinh_anh_phu') as $index => $file) {
            if ($file->isValid()) {
                $imageName = time() . '_detail_' . $index . '.' . $file->extension();
                $file->move(public_path('images/products'), $imageName);

                // Bắt buộc phải truyền MaHinhAnh tự sinh ở đây:
                \DB::table('hinh_anh_sp')->insert([
                    'MaHinhAnh' => 'HA' . \Illuminate\Support\Str::random(5), 
                    'MaSanPham' => $product->MaSanPham,
                    'DuongDan'  => $imageName
                ]);
            }
        }
    }

    return redirect()->route('admin.products')->with('success', 'Thêm sản phẩm thành công');
}

    public function edit($id)
    {
        $product = SanPham::findOrFail($id);
            $images = HinhAnhSP::where('MaSanPham', $id)->get(); 
        $categories = DanhMucSP::all();
        return view('admin.products/edit-product', compact('product', 'images', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = SanPham::findOrFail($id);
        
        $product->update([
            'TenSanPham' => $request->ten_sanpham,
            'MaDanhMuc'  => $request->ma_danhmuc,
            'GiaBan'     => $request->gia_ban,
            'ChatLieu'   => $request->chat_lieu,
            'MoTa'       => $request->mo_ta,
            'TrangThai'  => $request->trang_thai,
        ]);

        if ($request->has('deleted_images') && !empty($request->deleted_images)) {
            // Giả sử JS gửi lên mảng các MaHinhAnh cần xóa (ví dụ: ['HA001', 'HA002'])
            $deletedIds = is_array($request->deleted_images) ? $request->deleted_images : json_decode($request->deleted_images, true);
            
            if (!empty($deletedIds)) {
                // Lấy danh sách ảnh để xóa file vật lý trong folder public trước
                $imagesToDelete = HinhAnhSP::whereIn('MaHinhAnh', $deletedIds)->get();
                foreach ($imagesToDelete as $img) {
                    $filePath = public_path('images/products/' . $img->DuongDan);
                    if (file_exists($filePath)) {
                        @unlink($filePath); // Xóa file ảnh thật trong folder products
                    }
                }
                // Xóa các dòng dữ liệu ảnh đó trong Database
                HinhAnhSP::whereIn('MaHinhAnh', $deletedIds)->delete();
            }
        }
        
        // Xử lý Ô 1: hinh_anh_chinh (Ảnh đại diện Card)
        if ($request->hasFile('hinh_anh_chinh')) {
            $file = $request->file('hinh_anh_chinh');
            if ($file->isValid()) {
                $imageName = time() . '_main.' . $file->extension();
                $file->move(public_path('images/products'), $imageName); // Lưu vào folder products số nhiều

                HinhAnhSP::create([
                    'MaHinhAnh' => 'HA' . \Illuminate\Support\Str::random(5),
                    'MaSanPham' => $product->MaSanPham,
                    'DuongDan'  => $imageName
                ]);
            }
        }

        // Xử lý Ô 2 & Ô 3: hinh_anh_phu (Mảng các ảnh chi tiết gửi lên)
        if ($request->hasFile('hinh_anh_phu')) {
            foreach ($request->file('hinh_anh_phu') as $index => $file) {
                if ($file->isValid()) {
                    $imageName = time() . '_detail_' . $index . '.' . $file->extension();
                    $file->move(public_path('images/products'), $imageName); // Lưu vào folder products số nhiều

                    HinhAnhSP::create([
                        'MaHinhAnh' => 'HA' . \Illuminate\Support\Str::random(5),
                        'MaSanPham' => $product->MaSanPham,
                        'DuongDan'  => $imageName
                    ]);
                }
            }
        }

        return redirect()->route('admin.products')->with('success', 'Cập nhật sản phẩm và hình ảnh thành công');
    }

    public function destroy($id)
    {
        $product = SanPham::findOrFail($id);

        $images = HinhAnhSP::where('MaSanPham', $id)->get();
        
        foreach ($images as $img) {
            $filePath = public_path('images/products/' . $img->DuongDan);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }

        HinhAnhSP::where('MaSanPham', $id)->delete();
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Xóa sản phẩm và toàn bộ hình ảnh thành công!');
    }
    public function deleteImage($id)
    {
        $image = HinhAnhSP::where('MaHinhAnh', $id)->first();
        
        if ($image) {
            $imagePath = public_path('images/products/' . $image->DuongDan);
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }
            $image->delete();

            return response()->json([
                'success' => true, 
                'message' => 'Xóa ảnh vật lý và dữ liệu thành công!'
            ]);
        }

        return response()->json([
            'success' => false, 
            'message' => 'Không tìm thấy mã hình ảnh này!'
        ], 404);
    }
}