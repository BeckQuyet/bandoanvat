<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

/**
 * Admin ProductController - CRUD quan ly san pham

 */
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image' => 'nullable|url|max:500',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->only('name', 'description', 'price', 'quantity', 'category_id');

        // Upload anh len Cloudinary neu co file
        if ($request->hasFile('image_file')) {
            $uploadedFile = $request->file('image_file')->storeOnCloudinary('snackstore/products');
            $data['image'] = $uploadedFile->getSecurePath();
        } elseif ($request->filled('image')) {
            $data['image'] = $request->image;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image' => 'nullable|url|max:500',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->only('name', 'description', 'price', 'quantity', 'category_id');

        // Upload anh moi len Cloudinary neu co file
        if ($request->hasFile('image_file')) {
            $uploadedFile = $request->file('image_file')->storeOnCloudinary('snackstore/products');
            $data['image'] = $uploadedFile->getSecurePath();
        } elseif ($request->filled('image')) {
            $data['image'] = $request->image;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
    }
}
