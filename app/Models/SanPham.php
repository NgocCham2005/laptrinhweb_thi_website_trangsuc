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
        'MaDanhMuc'
    ];

    public function images()
    {
        return $this->hasMany(
            HinhAnhSP::class,
            'MaSanPham',
            'MaSanPham'
        );
    }

    public function reviews()
    {
        return $this->hasMany(
            DanhGia::class,
            'MaSanPham',
            'MaSanPham'
        );
    }
}