<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class AdminVoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::paginate(5);

        return view('admin.vouchers.index', compact('vouchers'));
    }
    public function create()
    {
        $lastVoucher = Voucher::orderBy('MaVoucher', 'desc')->first();

        if ($lastVoucher) {
            $number = (int) substr($lastVoucher->MaVoucher, 2);
            $newCode = 'VC' . str_pad($number + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newCode = 'VC001';
        }

        return view(
            'admin.vouchers.create',
            compact('newCode')
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'TenVoucher' => 'required|string|max:255',
            'DieuKien' => 'required|numeric|min:0',
            'GiaTriGiamToiDa' => 'required|numeric|min:0',
            'SoLanSuDung' => 'required|integer|min:1',
            'TrangThai' => 'required|in:0,1'
        ], [
            'TenVoucher.required' => 'Vui lòng nhập tên voucher.',
            'DieuKien.required' => 'Vui lòng nhập điều kiện áp dụng.',
            'GiaTriGiamToiDa.required' => 'Vui lòng nhập giá trị giảm tối đa.',
            'SoLanSuDung.required' => 'Vui lòng nhập số lần sử dụng.',
            'SoLanSuDung.min' => 'Số lần sử dụng phải lớn hơn 0.',
            'TrangThai.required' => 'Vui lòng chọn trạng thái.'
        ]);

        $lastVoucher = Voucher::orderBy('MaVoucher', 'desc')->first();

        if ($lastVoucher) {
            $number = (int) substr($lastVoucher->MaVoucher, 2);
            $newCode = 'VC' . str_pad($number + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newCode = 'VC001';
        }

        Voucher::create([
            'MaVoucher' => $newCode,
            'TenVoucher' => $request->TenVoucher,
            'DieuKien' => $request->DieuKien,
            'GiaTriGiamToiDa' => $request->GiaTriGiamToiDa,
            'SoLanSuDung' => $request->SoLanSuDung,
            'TrangThai' => $request->TrangThai,
        ]);

        return redirect()
            ->route('admin.vouchers')
            ->with('success', 'Thêm voucher thành công');
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
        $request->validate([
            'TenVoucher' => 'required|string|max:255',
            'DieuKien' => 'required|numeric|min:0',
            'GiaTriGiamToiDa' => 'required|numeric|min:0',
            'SoLanSuDung' => 'required|integer|min:1',
            'TrangThai' => 'required|in:0,1'
        ], [
            'TenVoucher.required' => 'Vui lòng nhập tên voucher.',
            'DieuKien.required' => 'Vui lòng nhập điều kiện áp dụng.',
            'GiaTriGiamToiDa.required' => 'Vui lòng nhập giá trị giảm tối đa.',
            'SoLanSuDung.required' => 'Vui lòng nhập số lần sử dụng.',
            'SoLanSuDung.min' => 'Số lần sử dụng phải lớn hơn 0.',
            'TrangThai.required' => 'Vui lòng chọn trạng thái.'
        ]);

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