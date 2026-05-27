<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model {
    protected $table = 'san_pham';
    protected $primaryKey = 'MaSanPham';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}