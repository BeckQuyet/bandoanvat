<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

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

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total' => $total,
            'note' => $request->note,
        ]);

        foreach ($orderItems as $item) {
            $order->items()->create($item);
        }

        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Đặt hàng thành công! Mã đơn #' . $order->id);
    }

    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }
}
