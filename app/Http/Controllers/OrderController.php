<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('details');

        // tìm kiếm
        if($request->keyword){

            $query->where(
                'MaDonHang',
                'like',
                '%'.$request->keyword.'%'
            )

            ->orWhere(
                'TenNguoiNhan',
                'like',
                '%'.$request->keyword.'%'
            );
        }

        // lọc trạng thái
        if($request->status != ''){

            $query->where(
                'TrangThai',
                $request->status
            );
        }

        $orders = $query
            ->orderByDesc('NgayDatHang')
            ->paginate(5)

            ->appends([
                'keyword'=>$request->keyword,
                'status'=>$request->status
            ]);

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }
    public function show($id)
    {
        $order = Order::with([
            'details.product'
        ])->findOrFail($id);

        return view(
            'admin.orders.show',
            compact('order')
        );
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'TrangThai' => 'required'
        ]);

        $order = Order::findOrFail($id);

        $order->TrangThai = $request->TrangThai;

        $order->save();

        return redirect()
            ->back()
            ->with(
                'success',
                'Cập nhật trạng thái thành công'
            );
    }
}