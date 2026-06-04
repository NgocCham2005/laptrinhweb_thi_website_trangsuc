<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model {
    protected $table = 'don_hang';
    protected $primaryKey = 'MaDonHang';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaDonHang', 'NgayDatHang', 'NgayThanhToan', 'PTTT',
        'TrangThai', 'TenNguoiNhan', 'SoDienThoai',
        'DiaChiGiaoHang', 'MaTaiKhoan', 'MaVoucher', 'GiaTriApDung'
    ];

    public function chiTietDonHang() {
        return $this->hasMany(ChiTietDonHang::class, 'MaDonHang', 'MaDonHang');
    }

    public function voucher() {
        return $this->belongsTo(Voucher::class, 'MaVoucher', 'MaVoucher');
    }
    public function getTongThanhToanAttribute()
    {
        $tongTien = $this->chiTietDonHang->sum(
            fn($d) => $d->SoLuong * $d->DonGia
        );

        return $tongTien - ($this->GiaTriApDung ?? 0);
    }
}