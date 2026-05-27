<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth; // TẠM THỜI — bật lại khi auth xong
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Models\ChiTietGioHang;
use App\Models\GioHang;
use App\Models\SanPham;
use App\Models\Voucher;

class OrderController extends Controller
{
    // TẠM THỜI — dùng tài khoản cứng để test
    private function layMaTaiKhoan() {
        return 'TK0001'; // TODO: thay bằng Auth::user()->MaTaiKhoan
    }

    // Tạo mã đơn hàng tự động
    private function taoMaDonHang() {
        $donHangCuoi = DonHang::orderBy('MaDonHang', 'desc')->first();
        $soMoi = $donHangCuoi ? ((int) substr($donHangCuoi->MaDonHang, 2)) + 1 : 1;
        return 'DH' . str_pad($soMoi, 4, '0', STR_PAD_LEFT);
    }

    // =====================
    // MUA NGAY (từ trang sản phẩm)
    // =====================
    public function muaNgay(Request $request) {
        $request->validate([
            'MaSanPham' => 'required|exists:san_pham,MaSanPham',
            'SoLuong'   => 'required|integer|min:1',
        ]);

        $sanPham = SanPham::findOrFail($request->MaSanPham);

        if ($sanPham->SoLuongTon < $request->SoLuong) {
            return back()->with('error', 'Sản phẩm không đủ số lượng trong kho!');
        }

        // Lưu tạm vào session
        session([
            'mua_ngay' => [
                'MaSanPham' => $request->MaSanPham,
                'SoLuong'   => (int) $request->SoLuong,
            ]
        ]);

        return redirect()->route('order.checkout');
    }

    // =====================
    // TRANG CHECKOUT
    // =====================
    public function checkout() {
        $maTaiKhoan = $this->layMaTaiKhoan();
        $vouchers   = Voucher::where('SoLanSuDung', '>', 0)->get();
        $gioHang    = null;

        // Flow MUA NGAY
        if (session('mua_ngay')) {
            $sp      = SanPham::findOrFail(session('mua_ngay.MaSanPham'));
            $soLuong = session('mua_ngay.SoLuong');

            $chiTiet = collect([(object)[
                'MaSanPham' => $sp->MaSanPham,
                'SoLuong'   => $soLuong,
                'sanPham'   => $sp,
            ]]);

            $tongTien = $soLuong * $sp->GiaBan;
            $nguonDat = 'mua_ngay';

            return view('order.checkout', compact('chiTiet', 'tongTien', 'vouchers', 'nguonDat', 'gioHang'));
        }

        // Flow GIỎ HÀNG
        $gioHang = GioHang::where('MaTaiKhoan', $maTaiKhoan)->first();
        if (!$gioHang) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $chiTiet = ChiTietGioHang::where('MaGio', $gioHang->MaGio)
            ->with('sanPham')
            ->get();

        if ($chiTiet->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $tongTien = $chiTiet->sum(fn($item) => $item->SoLuong * $item->sanPham->GiaBan);
        $nguonDat = 'gio_hang';

        return view('order.checkout', compact('chiTiet', 'tongTien', 'vouchers', 'nguonDat', 'gioHang'));
    }

    // =====================
    // ĐẶT HÀNG
    // =====================
    public function datHang(Request $request) {
        $request->validate([
            'TenNguoiNhan'   => 'required|string|max:100',
            'SoDienThoai'    => 'required|string|max:15',
            'DiaChiGiaoHang' => 'required|string|max:255',
            'PTTT'           => 'required|in:COD,CK',
            'MaVoucher'      => 'nullable|exists:voucher,MaVoucher',
        ]);

        $maTaiKhoan = $this->layMaTaiKhoan();
        $nguonDat   = $request->input('NguonDat', 'gio_hang');
        $gioHang    = null;

        // ── Lấy dữ liệu theo flow ──
        if ($nguonDat === 'mua_ngay' && session('mua_ngay')) {
            $sp      = SanPham::findOrFail(session('mua_ngay.MaSanPham'));
            $soLuong = session('mua_ngay.SoLuong');

            if ($sp->SoLuongTon < $soLuong) {
                return back()->with('error', "Sản phẩm '{$sp->TenSanPham}' không đủ số lượng tồn kho!");
            }

            $chiTiet  = collect([(object)[
                'MaSanPham' => $sp->MaSanPham,
                'SoLuong'   => $soLuong,
                'sanPham'   => $sp,
            ]]);
            $tongTien = $soLuong * $sp->GiaBan;

        } else {
            // Flow giỏ hàng
            $gioHang = GioHang::where('MaTaiKhoan', $maTaiKhoan)->first();
            if (!$gioHang) {
                return back()->with('error', 'Không tìm thấy giỏ hàng!');
            }

            $chiTiet = ChiTietGioHang::where('MaGio', $gioHang->MaGio)
                ->with('sanPham')
                ->get();

            if ($chiTiet->isEmpty()) {
                return back()->with('error', 'Giỏ hàng trống!');
            }

            // Kiểm tra tồn kho
            foreach ($chiTiet as $item) {
                if ($item->sanPham->SoLuongTon < $item->SoLuong) {
                    return back()->with('error', "Sản phẩm '{$item->sanPham->TenSanPham}' không đủ số lượng tồn kho!");
                }
            }

            $tongTien = $chiTiet->sum(fn($item) => $item->SoLuong * $item->sanPham->GiaBan);
        }

       // ── Xử lý voucher ──
$maVoucher    = null;
$giaTriApDung = 0;

if ($request->MaVoucher) {
    $voucher = Voucher::where('MaVoucher', $request->MaVoucher)
        ->where('SoLanSuDung', '>', 0)
        ->first();

    if ($voucher && $tongTien >= (float) $voucher->DieuKien) { // ← cast float
        $maVoucher    = $voucher->MaVoucher;
        $giaTriApDung = (float) $voucher->GiaTriGiamToiDa;     // ← bỏ min 50%
        $voucher->decrement('SoLanSuDung');
    }
}

        // ── Tạo đơn hàng ──
        $maDonHang = $this->taoMaDonHang();

        DonHang::create([
            'MaDonHang'      => $maDonHang,
            'NgayDatHang'    => now(),
            'NgayThanhToan'  => $request->PTTT === 'CK' ? now() : null,
            'PTTT'           => $request->PTTT,
            'TrangThai'      => 0,
            'TenNguoiNhan'   => $request->TenNguoiNhan,
            'SoDienThoai'    => $request->SoDienThoai,
            'DiaChiGiaoHang' => $request->DiaChiGiaoHang,
            'MaTaiKhoan'     => $maTaiKhoan,
            'MaVoucher'      => $maVoucher,
            'GiaTriApDung'   => $giaTriApDung,
        ]);

        // ── Tạo chi tiết + trừ tồn kho ──
        foreach ($chiTiet as $item) {
            ChiTietDonHang::create([
                'MaDonHang' => $maDonHang,
                'MaSanPham' => $item->MaSanPham,
                'SoLuong'   => $item->SoLuong,
                'DonGia'    => $item->sanPham->GiaBan,
            ]);
            $item->sanPham->decrement('SoLuongTon', $item->SoLuong);
        }

        // ── Dọn dẹp ──
        if ($nguonDat === 'mua_ngay') {
            session()->forget('mua_ngay');
        } elseif ($gioHang) {
            ChiTietGioHang::where('MaGio', $gioHang->MaGio)->delete();
        }

        return redirect()->route('order.success', $maDonHang)
            ->with('success', 'Đặt hàng thành công!');
    }

    // =====================
    // TRANG ĐẶT HÀNG THÀNH CÔNG
    // =====================
    public function success($maDonHang) {
        $donHang = DonHang::with('chiTietDonHang.sanPham')
            ->where('MaDonHang', $maDonHang)
            ->firstOrFail();

        return view('order.success', compact('donHang'));
    }
}