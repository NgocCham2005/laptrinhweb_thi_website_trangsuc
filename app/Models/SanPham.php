<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'san_pham';

    protected $primaryKey = 'MaSanPham';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'MaSanPham',
        'TenSanPham',
        'GiaBan',
        'ChatLieu',
        'MoTa',
        'SoLuongTon',
        'TrangThai',
        'MaDanhMuc',
        'NoiBat',
    ];

    // 1. Mối quan hệ với ảnh sản phẩm
    public function images()
    {
        return $this->hasMany(HinhAnhSP::class, 'MaSanPham', 'MaSanPham');
    }

    // 2. Mối quan hệ với đánh giá sản phẩm (dùng ở trang chi tiết)
    public function reviews()
    {
        return $this->hasMany(DanhGia::class, 'MaSanPham', 'MaSanPham');
    }

    // 3. Mối quan hệ với danh mục (dùng ở trang quản lý admin)
    public function category()
    {
        return $this->belongsTo(DanhMucSP::class, 'MaDanhMuc', 'MaDanhMuc');
    }
}