<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class TaiKhoan extends Authenticatable
{
    protected $table = 'tai_khoan';

    protected $primaryKey = 'MaTaiKhoan';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [

        'MaTaiKhoan',
        'HoTen',
        'TenDangNhap',
        'Email',
        'SoDienThoai',
        'MatKhau',
        'VaiTro',
        'TrangThai',
        'DiaChi'
    ];

    protected $hidden = [

        'MatKhau'
    ];

    // Laravel Auth dùng password
    public function getAuthPassword()
    {
        return $this->MatKhau;
    }

     // Laravel Auth dùng khóa chính này
    public function getAuthIdentifierName()
    {
        return 'MaTaiKhoan';
    }
}