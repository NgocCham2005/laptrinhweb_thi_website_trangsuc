<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HinhAnhSP extends Model
{
    protected $table = 'hinh_anh_sp';

    protected $primaryKey = 'MaHinhAnh';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'MaHinhAnh',
        'DuongDan',
        'MaSanPham'
    ];
}