<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GioHang extends Model {
    protected $table = 'gio_hang';
    protected $primaryKey = 'MaGio';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['MaGio', 'NgayTao', 'MaTaiKhoan'];

    public function chiTietGioHang() {
        return $this->hasMany(ChiTietGioHang::class, 'MaGio', 'MaGio');
    }
}