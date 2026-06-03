<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMucSP;
use App\Models\HinhAnhSP;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
$query = SanPham::with(['category', 'images']);

    // 2. Lọc theo Từ khóa (Mã sản phẩm HOẶC Tên sản phẩm)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('MaSanPham', 'LIKE', "%{$search}%")
              ->orWhere('TenSanPham', 'LIKE', "%{$search}%");
        });
    }

    // 3. Lọc theo Danh mục
    if ($request->filled('category_id')) {
        $query->where('MaDanhMuc', $request->category_id);
    }

    // 4. Lọc theo Trạng thái (Ẩn/Hiện)
    if ($request->has('status') && $request->status !== null && $request->status !== '') {
        $query->where('TrangThai', $request->status);
    }

    // 5. Lọc theo Tình trạng tồn kho (Sản phẩm sltk = 0 lọc riêng)
    if ($request->filled('stock_status')) {
        if ($request->stock_status === 'outofstock') {
            $query->where('SoLuongTon', 0); // Riêng 1 mục hết hàng
        } else {
            $query->where('SoLuongTon', '>', 0); // Còn hàng
        }
    }

    // 6. Thực hiện phân trang và GIỮ LẠI bộ lọc trên URL bằng withQueryString()
    $products = $query->paginate(5)->withQueryString();

    // 7. Vòng lặp lấy ảnh đầu tiên (Giữ nguyên logic gốc của m)
    foreach ($products as $product) {
        $product->first_image = \DB::table('hinh_anh_sp')
            ->where('MaSanPham', $product->MaSanPham)
            ->value('DuongDan'); 
    }

    // 8. Lấy thêm danh sách danh mục để đổ vào thẻ <select> trong file product-filter
    // M thay 'DanhMuc' bằng tên Model danh mục thực tế của m nha (ví dụ: Category hoặc DanhMuc)
    $categories = \App\Models\DanhMucSP::all(); 

    // Trả về view kèm cả 2 biến products và categories
    return view('admin.products.index', compact('products', 'categories'));
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
        'so_luong_ton'   => 'required|numeric|min:0',
        'chat_lieu'      => 'required',
        'hinh_anh_chinh' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Bắt buộc phải chọn ảnh 1
    ], [
        // Viết lại câu thông báo lỗi bằng tiếng Việt để popup hiện lên thân thiện
        'ma_sanpham.required'     => 'Mã sản phẩm không được bỏ trống.',
        'ma_sanpham.unique'       => 'Mã sản phẩm này đã tồn tại trong hệ thống.',
        'ten_sanpham.required'    => 'Tên sản phẩm không được bỏ trống.',
        'ma_danhmuc.required'     => 'Vui lòng chọn danh mục sản phẩm.',
        'gia_ban.required'        => 'Giá bán không được bỏ trống.',
        'gia_ban.numeric'         => 'Giá bán phải là số hợp lệ.',
        'so_luong_ton.required'   => 'Số lượng tồn không được bỏ trống.',
        'so_luong_ton.numeric'    => 'Số lượng tồn phải là số hợp lệ.',
        'chat_lieu.required'      => 'Chất liệu không được bỏ trống.',
        'hinh_anh_chinh.required' => 'Cần tải lên ít nhất 1 ảnh.',
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
            $isFeatured = $request->has('noi_bat') ? 1 : 0;
        $product->update([
            'TenSanPham' => $request->ten_sanpham,
            'MaDanhMuc'  => $request->ma_danhmuc,
            'GiaBan'     => $request->gia_ban,
            'ChatLieu'   => $request->chat_lieu,
            'MoTa'       => $request->mo_ta,
            'TrangThai'  => $request->trang_thai,
            'NoiBat' => $isFeatured,
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