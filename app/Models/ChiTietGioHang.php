<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model {
    protected $table = 'chi_tiet_gio_hang';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['MaGio', 'MaSanPham', 'SoLuong'];

    public function sanPham() {
        return $this->belongsTo(SanPham::class, 'MaSanPham', 'MaSanPham');
    }
}