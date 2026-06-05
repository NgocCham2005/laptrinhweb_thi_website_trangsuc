<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use App\Models\SanPham;

class CartController extends Controller
{
    // =====================================================================
    // HELPER: LẤY GIỎ HÀNG CỦA USER HIỆN TẠI
    // =====================================================================

    private function getMaTaiKhoan(): string
    {
        return Auth::user()->MaTaiKhoan;
    }

    private function layGioHang(): ?GioHang
    {
        return GioHang::where('MaTaiKhoan', $this->getMaTaiKhoan())->first();
    }

    /**
     * Lấy hoặc tạo mới giỏ hàng cho user.
     * Tách riêng để tránh tạo trùng khi dùng firstOrCreate.
     */
    private function layHoacTaoGioHang(): GioHang
    {
        return GioHang::firstOrCreate(
            ['MaTaiKhoan' => $this->getMaTaiKhoan()],
            [
                'MaGio'   => $this->sinhMaGio(),
                'NgayTao' => now(),
            ]
        );
    }

    /**
     * Sinh mã giỏ hàng duy nhất, tránh trùng với DB.
     */
  private function sinhMaGio(): string
{
    $cuoi = GioHang::orderBy('MaGio', 'desc')->first();

    if (!$cuoi) {
        return 'G0001';
    }

    $so = (int) substr($cuoi->MaGio, 1);
    $so++;

    return 'G' . str_pad($so, 4, '0', STR_PAD_LEFT);
}
    /**
     * Trả về JSON lỗi hoặc redirect lỗi tùy loại request.
     */
    private function phanHoiLoi(Request $request, string $message, int $status = 422)
    {
        if ($request->isJson() || $request->ajax()) {
            return response()->json(['success' => false, 'message' => $message], $status);
        }
        return back()->with('error', $message);
    }

    /**
     * Trả về JSON thành công hoặc redirect thành công tùy loại request.
     */
    private function phanHoiOk(Request $request, string $message, array $data = [])
    {
        if ($request->isJson() || $request->ajax()) {
            return response()->json(array_merge(['success' => true, 'message' => $message], $data));
        }
        return back()->with('success', $message);
    }

    // =====================================================================
    // XEM GIỎ HÀNG
    // =====================================================================

    public function index()
    {
        $gioHang  = $this->layGioHang();
        $chiTiet  = collect();
        $tongTien = 0;

        if ($gioHang) {
            $chiTiet = ChiTietGioHang::where('MaGio', $gioHang->MaGio)
                ->with('sanPham')
                ->get()
                ->filter(fn($item) => $item->sanPham !== null); // bỏ item có SP đã bị xóa

            $tongTien = $chiTiet->sum(
                fn($item) => $item->SoLuong * ($item->sanPham->GiaBan ?? 0)
            );
        }

        return view('cart.index', compact('chiTiet', 'tongTien', 'gioHang'));
    }

    // =====================================================================
    // THÊM SẢN PHẨM VÀO GIỎ
    // =====================================================================

    public function them(Request $request)
    {
        $request->validate([
            'MaSanPham' => 'required|string|exists:san_pham,MaSanPham',
            'SoLuong'   => 'required|integer|min:1|max:999',
        ]);

        $sanPham   = SanPham::findOrFail($request->MaSanPham);
        $soLuongYC = (int) $request->SoLuong;

        // Kiểm tra sản phẩm còn kinh doanh
        if (isset($sanPham->TrangThai) && $sanPham->TrangThai === 'ngung_ban') {
            return $this->phanHoiLoi($request, 'Sản phẩm này đã ngừng kinh doanh!');
        }
        // Lấy hoặc tạo giỏ hàng
        $gioHang = $this->layHoacTaoGioHang();
        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $chiTiet = ChiTietGioHang::where('MaGio', $gioHang->MaGio)
            ->where('MaSanPham', $request->MaSanPham)
            ->first();
        $soLuongHienTai = $chiTiet ? $chiTiet->SoLuong : 0;
        $soLuongMoi     = $soLuongHienTai + $soLuongYC;
        // Kiểm tra tồn kho tổng cộng
        if ($soLuongMoi > $sanPham->SoLuongTon) {
            $con = $sanPham->SoLuongTon - $soLuongHienTai;
            if ($con <= 0) {
                return $this->phanHoiLoi($request, 'Sản phẩm này đã đạt giới hạn số lượng trong giỏ hàng!');
            }
            return $this->phanHoiLoi($request, "Chỉ có thể thêm tối đa {$con} sản phẩm nữa (tồn kho: {$sanPham->SoLuongTon})!");
        }
        if ($chiTiet) {
            $chiTiet->update(['SoLuong' => $soLuongMoi]);
        } else {
            ChiTietGioHang::create([
                'MaGio'     => $gioHang->MaGio,
                'MaSanPham' => $request->MaSanPham,
                'SoLuong'   => $soLuongYC,
            ]);
        }

        return $this->phanHoiOk($request, 'Đã thêm sản phẩm vào giỏ hàng!', [
            'soLuongGio' => ChiTietGioHang::where('MaGio', $gioHang->MaGio)->sum('SoLuong'),
        ]);
    }

    // =====================================================================
    // SỬA SỐ LƯỢNG (hỗ trợ cả AJAX JSON lẫn form POST)
    // =====================================================================

    public function sua(Request $request)
    {
        // Đọc dữ liệu từ JSON body hoặc form POST
        $data      = $request->isJson() ? $request->json()->all() : $request->all();
        $maSanPham = trim($data['MaSanPham'] ?? '');
        $soLuong   = (int) ($data['SoLuong'] ?? 0);

        // Validate thủ công (vì có thể là JSON)
        if (empty($maSanPham)) {
            return $this->phanHoiLoi($request, 'Thiếu mã sản phẩm!');
        }
        if ($soLuong < 1 || $soLuong > 999) {
            return $this->phanHoiLoi($request, 'Số lượng không hợp lệ!');
        }
        $gioHang = $this->layGioHang();
        if (!$gioHang) {
            return $this->phanHoiLoi($request, 'Không tìm thấy giỏ hàng!', 404);
        }
        $chiTiet = ChiTietGioHang::where('MaGio', $gioHang->MaGio)
            ->where('MaSanPham', $maSanPham)
            ->first();
        if (!$chiTiet) {
            return $this->phanHoiLoi($request, 'Sản phẩm không có trong giỏ hàng!', 404);
        }
        $sanPham = SanPham::find($maSanPham);
        if (!$sanPham) {
            return $this->phanHoiLoi($request, 'Sản phẩm không tồn tại!', 404);
        }
        // Giới hạn theo tồn kho
        if ($soLuong > $sanPham->SoLuongTon) {
            $soLuong = $sanPham->SoLuongTon;
        }
        $chiTiet->update(['SoLuong' => $soLuong]);
        // Tính lại tổng tiền để trả về cho AJAX
        $tongTien = ChiTietGioHang::where('MaGio', $gioHang->MaGio)
            ->with('sanPham')
            ->get()
            ->sum(fn($i) => $i->SoLuong * ($i->sanPham->GiaBan ?? 0));
        return $this->phanHoiOk($request, 'Đã cập nhật số lượng!', [
            'soLuongMoi'  => $soLuong,
            'thanhTien'   => ($sanPham->GiaBan ?? 0) * $soLuong,
            'tongTien'    => $tongTien,
        ]);
    }

    // =====================================================================
    // XÓA SẢN PHẨM KHỎI GIỎ
    // =====================================================================

   public function xoa(Request $request) {
    $request->validate([
         'MaSanPham' => 'required|string|exists:san_pham,MaSanPham',
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