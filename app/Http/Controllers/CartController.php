<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth; // TẠM THỜI — bật lại khi auth xong
use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use App\Models\SanPham;

class CartController extends Controller
{
    // =====================
    // LẤY GIỎ HÀNG
    // =====================

    // TẠM THỜI — dùng tài khoản cứng để test, bật lại khi auth xong
    private function layGioHang() {
        $maTaiKhoan = 'TK0001'; // TODO: thay bằng Auth::user()->MaTaiKhoan
        return GioHang::where('MaTaiKhoan', $maTaiKhoan)->first();
    }

    // private function layGioHang() {
    //     $maTaiKhoan = Auth::user()->MaTaiKhoan;
    //     return GioHang::where('MaTaiKhoan', $maTaiKhoan)->first();
    // }

    // =====================
    // XEM GIỎ HÀNG
    // =====================
    public function index() {
        $gioHang = $this->layGioHang();
        $chiTiet = [];
        $tongTien = 0;

        if ($gioHang) {
            $chiTiet = ChiTietGioHang::where('MaGio', $gioHang->MaGio)
                ->with('sanPham')
                ->get();

            $tongTien = $chiTiet->sum(function($item) {
return $item->SoLuong * ($item->sanPham->GiaBan ?? 0);            });
        }

        return view('cart.index', compact('chiTiet', 'tongTien', 'gioHang'));
    }

    // =====================
    // THÊM SẢN PHẨM
    // =====================
    public function them(Request $request) {
        $request->validate([
            'MaSanPham' => 'required|exists:san_pham,MaSanPham',
            'SoLuong'   => 'required|integer|min:1',
        ]);

        // TẠM THỜI — dùng tài khoản cứng để test, bật lại khi auth xong
        $maTaiKhoan = 'TK0001'; // TODO: thay bằng Auth::user()->MaTaiKhoan

        $sanPham = SanPham::findOrFail($request->MaSanPham);

        // Kiểm tra tồn kho
        if ($sanPham->SoLuongTon < $request->SoLuong) {
            return back()->with('error', 'Sản phẩm không đủ số lượng trong kho!');
        }

        // Lấy hoặc tạo giỏ hàng
        $gioHang = GioHang::firstOrCreate(
            ['MaTaiKhoan' => $maTaiKhoan],
            [
                'MaGio'   => 'G' . uniqid(), // dùng uniqid() tránh trùng
                'NgayTao' => now(),
            ]
        );

        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $chiTiet = ChiTietGioHang::where('MaGio', $gioHang->MaGio)
            ->where('MaSanPham', $request->MaSanPham)
            ->first();

        if ($chiTiet) {
            // Đã có → cộng thêm số lượng
            $soLuongMoi = $chiTiet->SoLuong + $request->SoLuong;
            if ($soLuongMoi > $sanPham->SoLuongTon) {
                return back()->with('error', 'Vượt quá số lượng tồn kho!');
            }
           ChiTietGioHang::where('MaGio', $gioHang->MaGio)
        ->where('MaSanPham', $request->MaSanPham)
        ->update(['SoLuong' => $soLuongMoi]);
        } else {
            // Chưa có → thêm mới
            ChiTietGioHang::create([
                'MaGio'     => $gioHang->MaGio,
                'MaSanPham' => $request->MaSanPham,
                'SoLuong'   => $request->SoLuong,
            ]);
        }

        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    // =====================
    // SỬA SỐ LƯỢNG
    // =====================
    public function sua(Request $request) {
        $request->validate([
            'MaSanPham' => 'required',
            'SoLuong'   => 'required|integer|min:1',
        ]);

        $gioHang = $this->layGioHang();
        if (!$gioHang) {
            return back()->with('error', 'Không tìm thấy giỏ hàng!');
        }

        $sanPham = SanPham::findOrFail($request->MaSanPham);
        if ($request->SoLuong > $sanPham->SoLuongTon) {
            return back()->with('error', 'Vượt quá số lượng tồn kho!');
        }

        ChiTietGioHang::where('MaGio', $gioHang->MaGio)
            ->where('MaSanPham', $request->MaSanPham)
            ->update(['SoLuong' => $request->SoLuong]);

        return back()->with('success', 'Đã cập nhật số lượng!');
    }

    // =====================
    // XÓA SẢN PHẨM
    // =====================
    public function xoa(Request $request) {
        $request->validate([
            'MaSanPham' => 'required',
        ]);

        $gioHang = $this->layGioHang();
        if (!$gioHang) {
            return back()->with('error', 'Không tìm thấy giỏ hàng!');
        }

        ChiTietGioHang::where('MaGio', $gioHang->MaGio)
            ->where('MaSanPham', $request->MaSanPham)
            ->delete();

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }
}