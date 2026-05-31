<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SanPham;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = SanPham::where('TenDanhMuc', 'Nhẫn')
        ->join('danh_muc', 'danh_muc.MaDanhMuc', '=', 'san_pham.MaDanhMuc')
        ->get();

        $newProducts = SanPham::where('TenDanhMuc', 'Dây chuyền')
        ->join('danh_muc', 'danh_muc.MaDanhMuc', '=', 'san_pham.MaDanhMuc')
        ->get();

        $bestSellingProducts = SanPham::select(
                'san_pham.MaSanPham',
                'san_pham.TenSanPham',
                'san_pham.GiaBan'
            )
            ->join('chi_tiet_don_hang', 'chi_tiet_don_hang.MaSanPham', '=', 'san_pham.MaSanPham')
            ->selectRaw('SUM(chi_tiet_don_hang.SoLuong) as total_sold')
            ->groupBy(
                'san_pham.MaSanPham',
                'san_pham.TenSanPham',
                'san_pham.GiaBan'
            )
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        return view('home.index', compact(
            'featuredProducts',
            'newProducts',
            'bestSellingProducts'
        ));
    }
}