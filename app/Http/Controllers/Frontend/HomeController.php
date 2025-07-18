<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
class HomeController extends Controller
{
    function index()
    {
        // Sản phẩm đang sale
        $saleProducts = Product::with('mainImage')
            ->whereNotNull('sale_price')
            ->whereColumn('sale_price', '<', 'price')
            ->where('is_active', 1)
            ->take(4)
            ->get();

        // Sản phẩm bán chạy
        $bestSelling = Product::with('mainImage', 'category')
            ->where('stock', '<', 100)
            ->where('is_active', 1)
            ->take(4)
            ->get();

        // Sản phẩm mới nhất
        $newProducts = Product::with('mainImage', 'category')
            ->where('is_active', 1)
            ->latest()
            ->take(4)
            ->get();

        return view('index', [
            'saleProducts' => $saleProducts,
            'bestSelling' => $bestSelling,
            'newProducts' => $newProducts,
        ]);
    }
}
