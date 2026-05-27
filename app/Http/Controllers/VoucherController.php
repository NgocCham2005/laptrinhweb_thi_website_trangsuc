<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::paginate(5);

        return view('admin.vouchers.index', compact('vouchers'));
    }
    public function create()
    {
        return view('admin.vouchers.create');
    }
    public function store(Request $request)
    {
        Voucher::create([
            'MaVoucher' => $request->MaVoucher,
            'TenVoucher' => $request->TenVoucher,
            'DieuKien' => $request->DieuKien,
            'GiaTriGiamToiDa' => $request->GiaTriGiamToiDa,
            'SoLanSuDung' => $request->SoLanSuDung,
            'TrangThai' => $request->TrangThai,
        ]);

        return redirect()->route('admin.vouchers');
    }

    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view(
            'admin.vouchers.edit',
            compact('voucher')
        );
    }

    public function update(
        Request $request,
        $id
    )
    {

        $voucher = Voucher::findOrFail($id);
        $voucher->update([
            'TenVoucher' => $request->TenVoucher,
            'DieuKien' => $request->DieuKien,
            'GiaTriGiamToiDa' => $request->GiaTriGiamToiDa,
            'SoLanSuDung' => $request->SoLanSuDung,
            'TrangThai' => $request->TrangThai
        ]);

        return redirect()
            ->route('admin.vouchers')
            ->with(
                'success',
                'Cập nhật thành công'
            );
    }
    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);

        $voucher->update([
            'TrangThai' => 0
        ]);

        return redirect()
            ->route('admin.vouchers')
            ->with(
                'success',
                'Đã vô hiệu hóa voucher'
            );
    }

}