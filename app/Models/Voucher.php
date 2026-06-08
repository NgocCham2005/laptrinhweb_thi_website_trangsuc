<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher';

    protected $primaryKey = 'MaVoucher';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
    'MaVoucher',
    'TenVoucher',
    'DieuKien',
    'GiaTriGiamToiDa',
    'NgayHetHan',
    'SoLuong',
    'TrangThai'
];
}