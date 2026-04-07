<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

/**
 * OrderController - Xu ly don hang phia nguoi dung
 * Yeu cau dang nhap de dat hang va xem don hang
 */
class OrderController extends Controller
{
    // Hien thi danh sach don hang cua nguoi dung hien tai
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    // Tao don hang moi tu gio hang (checkout)
    // Chuyen san pham trong session cart thanh ban ghi trong DB
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        $total = 0;
        $orderItems = [];

        foreach ($cart as $productId => $qty) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal = $product->price * $qty;
                $total += $subtotal;
                $orderItems[] = [
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'price' => $product->price,
                ];
            }
        }

        // Tao don hang moi voi trang thai mac dinh la 'pending'
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total' => $total,
            'note' => $request->note,
        ]);

        // Luu chi tiet tung san pham vao bang order_items
        foreach ($orderItems as $item) {
            $order->items()->create($item);
        }

        // Xoa gio hang sau khi dat hang thanh cong
        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Đặt hàng thành công! Mã đơn #' . $order->id);
    }

    // Xem chi tiet 1 don hang (chi cho phep xem don hang cua chinh minh)
    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }
}
