<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietPhanHoi extends Model
{
    protected $table = 'chi_tiet_phan_hoi';

    public $timestamps = false;

    protected $fillable = [

        'MaDanhGia',
        'MaTaiKhoan',
        'NoiDungPhanHoi',
        'NgayPhanHoi'

    ];

    public function review()
    {
        return $this->belongsTo(
            DanhGia::class,
            'MaDanhGia',
            'MaDanhGia'
        );
    }
}