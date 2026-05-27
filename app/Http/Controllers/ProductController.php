<?php

namespace App\Http\Controllers;

use App\Models\SanPham;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = SanPham::with('images')->findOrFail($id);

        $relatedProducts = SanPham::where('MaDanhMuc',$product->MaDanhMuc)->where('MaSanPham','!=', $id)->take(3)->get();

        return view('products.detail',compact('product','relatedProducts')
        );
    }
}