<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = DonHang::with('chiTietDonHang');
        # Tìm kiếm theo mã đơn hàng hoặc tên người nhận
        if ($request->keyword) {
            $query->where('MaDonHang', 'like', '%'.$request->keyword.'%')
                  ->orWhere('TenNguoiNhan', 'like', '%'.$request->keyword.'%');
        }
        # Lọc theo trạng thái đơn hàng
        if ($request->status != '') {
            $query->where('TrangThai', $request->status);
        }

        $orders = $query->orderByDesc('NgayDatHang')
                        ->paginate(5)
                        ->appends([
                            'keyword' => $request->keyword,
                            'status' => $request->status
                        ]);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = DonHang::with(['chiTietDonHang.sanPham'])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'TrangThai' => 'required|integer'
        ]);

        $order = DonHang::findOrFail($id);

        $current = (int)$order->TrangThai;
        $new = (int)$request->TrangThai;

        // QTV chỉ được thao tác khi trạng thái < 2
        if ($current >= 2) {
            return back()->with(
                'error',
                'Đơn hàng đang giao hoặc đã kết thúc.'
            );
        }

        // Chỉ được chuyển tiếp 1 bước
        if ($new !== $current + 1) {
            return back()->with(
                'error',
                'Chỉ được chuyển sang trạng thái tiếp theo.'
            );
        }

        $order->TrangThai = $new;
        $order->save();

        return back()->with(
            'success',
            'Cập nhật trạng thái thành công.'
        );
    }
}