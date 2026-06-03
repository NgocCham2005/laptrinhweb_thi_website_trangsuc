<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMucSP extends Model
{
    protected $table = 'danh_muc';
    protected $primaryKey = 'MaDanhMuc';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'MaDanhMuc',
        'TenDanhMuc',
        'TrangThai',
        'HinhAnh'
    ];
}