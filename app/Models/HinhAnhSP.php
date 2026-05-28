<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HinhAnhSP extends Model
{
    protected $table = 'hinh_anh_sp';

    protected $primaryKey = 'MaHinhAnh';

    public $timestamps = false;

    protected $fillable = [
        'MaHinhAnh',
        'DuongDan',
        'MaSanPham'
    ];
}