<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model {
    protected $table    = 'chi_tiet_gio_hang';
    protected $primaryKey = null;   // composite key, không có PK đơn
    public $incrementing  = false;
    public $timestamps    = false;

    protected $fillable = ['MaGio', 'MaSanPham', 'SoLuong'];

    // Bắt buộc khai báo để save() / update() hoạt động đúng với composite key
    protected function setKeysForSaveQuery($query) {
        return $query
            ->where('MaGio',     $this->MaGio)
            ->where('MaSanPham', $this->MaSanPham);
    }

    public function sanPham() {
        return $this->belongsTo(SanPham::class, 'MaSanPham', 'MaSanPham');
    }

    public function gioHang() {
        return $this->belongsTo(GioHang::class, 'MaGio', 'MaGio');
    }
}