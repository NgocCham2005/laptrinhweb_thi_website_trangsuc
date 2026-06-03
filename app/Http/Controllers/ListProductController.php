<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMucSP;

class ListProductController extends Controller
{
public function index(Request $request)
{
    $categories = DanhMucSP::where('TrangThai', 1)->get();
    
    // Lấy danh sách chất liệu không trùng lặp
    $materials = SanPham::where('TrangThai', 1)
                ->whereNotNull('ChatLieu')
                ->where('ChatLieu', '<>', '')
                ->pluck('ChatLieu')
                ->unique();

    // Hứng dữ liệu an toàn từ Request query
    $selectedCategory = $request->query('danh_muc', 'all'); // Mặc định là all nếu rỗng
    if (empty($selectedCategory)) {
        $selectedCategory = 'all';
    }

    $searchKeyword  = $request->query('search');    
    $priceFilter    = $request->query('gia');          
    $materialFilter = $request->query('chat_lieu');  
    $sortFilter     = $request->query('sort'); 

    // Tạo base query
    $query = SanPham::where('TrangThai', 1)->with(['images']);

    // ĐIỀU KIỆN 1: Lọc theo Danh mục
    if ($selectedCategory && $selectedCategory !== 'all') {
        $query->where('MaDanhMuc', $selectedCategory);
    }

    // ĐIỀU KIỆN 2: Tìm kiếm theo tên
    if ($searchKeyword) {
        $query->where('TenSanPham', 'LIKE', '%' . $searchKeyword . '%');
    }

    // ĐIỀU KIỆN 3: Lọc theo khoảng giá
    if ($priceFilter) {
        if ($priceFilter === 'duoi-5tr') {
            $query->where('GiaBan', '<', 4500000);
        } elseif ($priceFilter === '5tr-10tr') {
            $query->where('GiaBan', '>=', 4500000)->where('GiaBan', '<=', 10000000);
        } elseif ($priceFilter === 'tren-10tr') {
            $query->where('GiaBan', '>', 10000000);
        }
    }

    // ĐIỀU KIỆN 4: Lọc theo Chất liệu
    if ($materialFilter && $materialFilter !== 'all') {
        $query->where('ChatLieu', $materialFilter);
    }

    // ĐIỀU KIỆN 5: Sắp xếp
    if ($sortFilter) {
        if ($sortFilter === 'gia-thap-cao') {
            $query->orderBy('GiaBan', 'asc');
        } elseif ($sortFilter === 'gia-cao-thap') {
            $query->orderBy('GiaBan', 'desc');
        }
    }

    // Phân trang giữ nguyên Query String trên URL
    $products = $query->paginate(9)->withQueryString();

    return view('products.index', compact(
        'categories', 'products', 'selectedCategory', 
        'searchKeyword', 'priceFilter', 'materialFilter', 'sortFilter', 'materials'
    ));
}
}