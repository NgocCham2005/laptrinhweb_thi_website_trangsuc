<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();

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
}