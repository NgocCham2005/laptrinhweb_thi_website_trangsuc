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

        $selectedCategory = $request->query('danh_muc'); // Bộ lọc danh mục
        $searchKeyword = $request->query('search');     // Bộ lọc từ khóa tìm kiếm
        $priceFilter = $request->query('gia');           // Bộ lọc khoảng giá
        $materialFilter = $request->query('chat_lieu');  // Bộ lọc chất liệu

        $query = SanPham::where('TrangThai', 1)->with(['images']);

        // ĐIỀU KIỆN 1: Kết hợp lọc theo Danh mục (nếu có chọn và không phải 'all')
        if ($selectedCategory && $selectedCategory !== 'all') {
            $query->where('MaDanhMuc', $selectedCategory);
        }

        // ĐIỀU KIỆN 2: Kết hợp TÌM KIẾM THEO TÊN SẢN PHẨM
        if ($searchKeyword) {
            $query->where('TenSanPham', 'LIKE', '%' . $searchKeyword . '%');
        }

        // ĐIỀU KIỆN 3: Kết hợp lọc theo Khoảng Giá
        if ($priceFilter) {
            if ($priceFilter === 'duoi-5tr') {
                $query->where('GiaBan', '<', 4500000);
            } elseif ($priceFilter === '5tr-10tr') {
                $query->where('GiaBan', '>=', 4500000)->where('GiaBan', '<=', 10000000);
            } elseif ($priceFilter === 'tren-10tr') {
                $query->where('GiaBan', '>', 10000000);
            }
        }

        // ĐIỀU KIỆN 4: Kết hợp lọc theo Chất liệu
        if ($materialFilter && $materialFilter !== 'all') {
            $query->where('ChatLieu', $materialFilter);
        }
        $products = $query->paginate(9)->withQueryString();

        return view('products.index', compact('categories', 'products', 'selectedCategory','searchKeyword', 'priceFilter', 'materialFilter'));
    }
}