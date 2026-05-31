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
    public function scopeBestSelling($query)
    {
        return $query->select('products.*')
            ->join('order_details', 'order_details.product_id', '=', 'products.id')
            ->selectRaw('SUM(order_details.quantity) as total_sold')
            ->groupBy('products.id')
            ->orderByDesc('total_sold');
    }
}
