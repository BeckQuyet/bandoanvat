<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

/**
 * HomeController - Xu ly trang chu va trang chi tiet san pham
 */
class HomeController extends Controller
{
    // Trang chu: hien thi san pham, loc theo danh muc, tim kiem theo ten
    public function index(Request $request)
    {
        $categories = Category::all();
        $currentCategory = null;

        $query = Product::with('category');

        if ($request->has('category')) {
            $currentCategory = Category::where('slug', $request->category)->first();
            if ($currentCategory) {
                $query->where('category_id', $currentCategory->id);
            }
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        return view('home', compact('products', 'categories', 'currentCategory'));
    }

    // Trang chi tiet san pham: hien thi thong tin + san pham lien quan cung danh muc
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        $relatedProducts = collect();
        if ($product->category_id) {
            $relatedProducts = Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->limit(4)
                ->get();
        }

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
