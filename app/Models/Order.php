<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='don_hang';

    protected $primaryKey='MaDonHang';

    public $incrementing=false;

    protected $keyType='string';

    public $timestamps=false;

    protected $fillable=[
        'MaDonHang',
        'NgayDatHang',
        'NgayThanhToan',
        'PTTT',
        'TrangThai',
        'TenNguoiNhan',
        'SoDienThoai',
        'DiaChiGiaoHang',
        'MaTaiKhoan',
        'MaVoucher',
        'GiaTriApDung'
    ];

    public function details()
    {
        return $this->hasMany(
            OrderDetail::class,
            'MaDonHang',
            'MaDonHang'
        );
    }
}