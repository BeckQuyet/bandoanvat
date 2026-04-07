<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

/**
 * CartController - Xu ly gio hang (luu trong session)
 * Nguoi dung khong can dang nhap de them san pham vao gio hang
 */
class CartController extends Controller
{
    // Hien thi trang gio hang voi danh sach san pham va tong tien
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

    // Them san pham vao gio hang (kiem tra ton kho truoc)
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Kiem tra con hang khong
        if ($product->quantity <= 0) {
            return redirect()->back()->with('error', "\"{ $product->name}\" da het hang!");
        }

        $cart = session()->get('cart', []);
        $currentQty = $cart[$productId] ?? 0;

        // Kiem tra so luong trong gio khong vuot qua ton kho
        if ($currentQty >= $product->quantity) {
            return redirect()->back()->with('error', "Chi con {$product->quantity} san pham \"{$product->name}\" trong kho!");
        }

        $cart[$productId] = $currentQty + 1;
        session()->put('cart', $cart);

        return redirect()->back()->with('success', "Đã thêm \"{$product->name}\" vào giỏ hàng!");
    }

    // Cap nhat so luong san pham trong gio hang (kiem tra ton kho)
    public function update(Request $request, $productId)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:99']);
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $product = Product::find($productId);
            if ($product && $request->quantity > $product->quantity) {
                return redirect()->route('cart.index')->with('error', "Chi con {$product->quantity} san pham \"{$product->name}\" trong kho!");
            }
            $cart[$productId] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Đã cập nhật số lượng.');
    }

    // Xoa san pham khoi gio hang
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
