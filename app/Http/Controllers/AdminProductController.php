<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMucSP;

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
        $product = SanPham::create([
            'MaSanPham'  => $request->ma_sanpham,
            'TenSanPham' => $request->ten_sanpham,
            'MaDanhMuc'  => $request->ma_danhmuc,
            'GiaBan'     => $request->gia_ban,
            'ChatLieu'   => $request->chat_lieu,
            'MoTa'       => $request->mo_ta,
            'TrangThai'  => 1
        ]);
    // if ($request->hasFile('hinh_anh')) {
    //     foreach ($request->file('hinh_anh') as $index => $file) {
    //         if ($file->isValid()) {
    //             $imageName = time() . '.' . $file->extension();
    //             $file->move(public_path('images/product'), $imageName);

    //     // Lưu dòng dữ liệu mới vào bảng hình ảnh sản phẩm bằng Query Builder hoặc Model
    //     \DB::table('hinh_anh_sp')->insert([
    //         'MaHinhAnh' => 'HA' . \Illuminate\Support\Str::random(5),
    //         'MaSanPham' => $product->MaSanPham,
    //         'DuongDan' => $imageName
    //     ]);
    //         }
    //     }
    if ($request->hasFile('hinh_anh_chinh')) {
        $pathChinh = $request->file('hinh_anh_chinh')->store('images/sanpham', 'public');
        HinhAnhSP::create([
             'MaSanPham' => $product->id,
             'DuongDan' => $pathChinh,
             'LoaiAnh' => 1 // 1 là ảnh chính
        ]);
    }
    if ($request->hasFile('hinh_anh_phu')) {
        foreach ($request->file('hinh_anh_phu') as $filePhu) {
            $pathPhu = $filePhu->store('images/sanpham', 'public');

             HinhAnhSP::create([
                 'MaSanPham' => $product->id,
                 'DuongDan' => $pathPhu,
                 'LoaiAnh' => 0 // 0 là ảnh phụ
            ]);
        }
    }
        return redirect()->route('admin.products')->with('success', 'Thêm sản phẩm thành công');
    }

    public function edit($id)
    {
        $product = SanPham::findOrFail($id);
        $categories = DanhMucSP::where('TrangThai', 1)->get();
        $images = \DB::table('hinh_anh_sp')->where('MaHinhAnh', $id)->get();
        return view('admin.products.edit-product', compact('product', 'categories','images'));
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
        if ($request->hasFile('hinh_anh')) {
        
        // Vòng lặp duyệt qua từng file ảnh trong mảng gửi lên
        foreach ($request->file('hinh_anh') as $index => $file) {
            if ($file->isValid()) {
                
                // Đặt tên file ảnh phân biệt bằng cách thêm chỉ số $index và thời gian
                $imageName = time() . '_' . $index . '.' . $file->extension();
                $file->move(public_path('images/product'), $imageName);

                // Chèn từng ảnh một vào bảng hinh_anh_sp
                \DB::table('hinh_anh_sp')->insert([
                    'MaHinhAnh' => 'HA' . \Illuminate\Support\Str::random(5), // Mã ngẫu nhiên không lo bị trùng/quá dài
                    'MaSanPham' => $product->MaSanPham,
                    'DuongDan'  => $imageName
                ]);
            }
        }
    }
        return redirect()->route('admin.products')->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function destroy($id)
    {
        $product = SanPham::findOrFail($id);
        // Kiểm tra xem sản phẩm này đã nằm trong chi tiết đơn hàng nào chưa
        $isUsed = \DB::table('chi_tiet_don_hang')->where('MaSanPham', $id)->exists();

        if ($isUsed) {
            // TRƯỜNG HỢP 1: Có ràng buộc dữ liệu -> Chuyển sang ẨN
            $product->update([
                'TrangThai' => 0
            ]);
            return redirect()->route('admin.products')->with('success', 'Sản phẩm đã có lịch sử mua hàng nên hệ thống đã tự động chuyển sang trạng thái ẨN!');
        } else {
            // TRƯỜNG HỢP 2: Hoàn toàn không bị ràng buộc -> XÓA HẲN
            // Xóa file ảnh vật lý trong thư mục trước
            $imagePath = public_path('images/product/' . $product->HinhAnh);
            if ($product->HinhAnh && file_exists($imagePath)) {
                unlink($imagePath);
            }
            // Xóa bản ghi trong database
            $product->delete();
            return redirect()->route('admin.products')->with('success', 'Xóa sản phẩm thành công!');
        }
    }
    public function deleteImage($id)
{
    // Tìm ảnh trong DB để lấy tên file xóa trong thư mục public
    $image = \DB::table('hinh_anh_sp')->where('MaHinhAnh', $id)->first();
    
    if ($image) {
        // Xóa file ảnh vật lý trong thư mục public/images/product
        $imagePath = public_path('images/product/' . $image->DuongDan);
        if (file_exists($imagePath)) {
            @unlink($imagePath);
        }

        // Xóa dòng dữ liệu trong DB
        \DB::table('hinh_anh_sp')->where('MaHinhAnh', $id)->delete();

        return response()->json(['success' => true, 'message' => 'Xóa ảnh thành công!']);
    }

    return response()->json(['success' => false, 'message' => 'Không tìm thấy ảnh!'], 404);
}
}