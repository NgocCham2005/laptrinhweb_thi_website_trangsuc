<?php

namespace App\Http\Controllers;

use App\Models\SanPham;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = SanPham::with(['images','reviews' => function($query){ 
            $query->where('TrangThai',1);
            }, 'reviews.replies'])->findOrFail($id);

        $relatedProducts = SanPham::where('MaDanhMuc',$product->MaDanhMuc)->where('MaSanPham','!=', $id)->take(4)->get();

        return view('products.detail',compact('product','relatedProducts'));
    }
}