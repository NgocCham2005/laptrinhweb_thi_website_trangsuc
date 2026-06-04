<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use App\Models\ChiTietDonHang;
use App\Models\Voucher;

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

    public function chiTietDonHang(): HasMany {
        return $this->hasMany(ChiTietDonHang::class, 'MaDonHang', 'MaDonHang');
    }

    public function voucher(): BelongsTo {
        return $this->belongsTo(Voucher::class, 'MaVoucher', 'MaVoucher');
    }

    public function getTongThanhToanAttribute()
    {
        $tongTien = $this->chiTietDonHang()
            ->sum(DB::raw('SoLuong * DonGia'));

        return $tongTien - ($this->GiaTriApDung ?? 0);
    }
}