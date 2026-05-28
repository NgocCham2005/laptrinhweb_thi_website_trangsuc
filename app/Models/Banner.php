<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';

    protected $primaryKey = 'MaBanner';

    public $timestamps = false;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'MaBanner',
        'TenBanner',
        'HinhAnh',
        'TrangThai'
    ];
}