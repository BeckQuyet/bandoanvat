<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $productId => $qty) {
            $product = Product::find($productId);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $qty,
                    'subtotal' => $product->price * $qty,
                ];
                $total += $product->price * $qty;
            }
        }

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        $cart[$productId] = ($cart[$productId] ?? 0) + 1;
        session()->put('cart', $cart);

        return redirect()->back()->with('success', "Đã thêm \"{$product->name}\" vào giỏ hàng!");
    }

    public function update(Request $request, $productId)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:99']);
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Đã cập nhật số lượng.');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    public function count()
    {
        return array_sum(session()->get('cart', []));
    }
}
