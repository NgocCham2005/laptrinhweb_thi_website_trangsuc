<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table='chi_tiet_don_hang';

    public $timestamps=false;

    protected $fillable=[
        'MaDonHang',
        'MaSanPham',
        'SoLuong',
        'DonGia'
    ];

    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'MaSanPham',
            'MaSanPham'
        );
    }
}