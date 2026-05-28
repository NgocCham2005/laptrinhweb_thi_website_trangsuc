<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model {
    protected $table = 'chi_tiet_don_hang';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['MaDonHang', 'MaSanPham', 'SoLuong', 'DonGia'];

    public function sanPham() {
        return $this->belongsTo(SanPham::class, 'MaSanPham', 'MaSanPham');
    }
}