<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    protected $table = 'danh_gia';

    protected $primaryKey = 'MaDanhGia';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'MaDanhGia',
        'BinhLuan',
        'XepHang',
        'NgayTao',
        'TrangThai',
        'MaTaiKhoan',
        'MaSanPham',
        'MaDonHang'
    ];

    public function product()
    {
        return $this->belongsTo(SanPham::class,'MaSanPham','MaSanPham');
    }

    public function replies()
    {
        return $this->hasMany(ChiTietPhanHoi::class,'MaDanhGia','MaDanhGia');
    }
}
