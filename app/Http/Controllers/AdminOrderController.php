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
        $request->validate(['TrangThai' => 'required']);

        $order = DonHang::findOrFail($id);
        $order->TrangThai = $request->TrangThai;
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }
}