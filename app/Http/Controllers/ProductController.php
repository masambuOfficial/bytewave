<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(9);
        return view('products.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->when($product->category, function($query) use ($product) {
                return $query->where('category', $product->category);
            })
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
