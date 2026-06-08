<?php
namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DanhMucSP;

class HomeController extends Controller
{
    public function index()
    {
        $categories = DanhMucSP::where('TrangThai', 1)->get();

        $featuredProducts = SanPham::where('TrangThai', 1)
            ->limit(10)
            ->get();

        $newProducts = SanPham::where('TrangThai', 1)
            ->orderByRaw("CAST(SUBSTRING(MaSanPham, 3) AS UNSIGNED) DESC")
            ->limit(10)
            ->get();

        $bestSellingProducts = SanPham::select(
                'san_pham.MaSanPham',
                'san_pham.TenSanPham',
                'san_pham.GiaBan',
                'san_pham.ChatLieu')
            ->join('chi_tiet_don_hang', 'chi_tiet_don_hang.MaSanPham', '=', 'san_pham.MaSanPham')
            ->selectRaw('SUM(chi_tiet_don_hang.SoLuong) as total_sold')
            ->groupBy(
                'san_pham.MaSanPham',
                'san_pham.TenSanPham',
                'san_pham.GiaBan',
                'san_pham.ChatLieu'
            )
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        return view('home.index', compact(
            'categories',
            'featuredProducts',
            'newProducts',
            'bestSellingProducts'
        ));
    }
}