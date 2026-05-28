<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\DanhMucSP;

class ListProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = DanhMucSP::where('TrangThai', 1)->get();

        $selectedCategory = $request->query('danh_muc');
        $query = Product::where('TrangThai', 1)->with(['images']);

        if ($selectedCategory && $selectedCategory !== 'all') {
            $query->where('MaDanhMuc', $selectedCategory);
        }
        $products = $query->paginate(9)->withQueryString();

        return view('products.index', compact('categories', 'products', 'selectedCategory'));
    }
}