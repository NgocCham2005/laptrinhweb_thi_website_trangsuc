<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HinhAnhSP;

class Product extends Model
{
    protected $table = 'san_pham';

    protected $primaryKey = 'MaSanPham';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'MaSanPham',
        'TenSanPham',
        'MaDanhMuc',
        'GiaBan',
        'ChatLieu',
        'MoTa',
        'TrangThai'
    ];

    // Tạo liên kết với bảng danh mục để hiển thị tên danh mục thay vì mã
    public function category()
    {
        return $this->belongsTo(DanhMucSP::class, 'MaDanhMuc', 'MaDanhMuc');
    }
    public function images()
    {
        return $this->hasMany(HinhAnhSP::class, 'MaSanPham', 'MaSanPham');
    }

}