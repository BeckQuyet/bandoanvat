<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class VNPayController extends Controller
{
    // Thông tin VNPay Sandbox (thay bằng thông tin thật khi deploy)
    private $vnp_TmnCode;
    private $vnp_HashSecret;
    private $vnp_Url;
    private $vnp_ReturnUrl;

    public function __construct()
    {
        $this->vnp_TmnCode   = env('VNPAY_TMN_CODE', 'DEMOV210');
        $this->vnp_HashSecret = env('VNPAY_HASH_SECRET', 'RAOEXHYVSDDIIENYWSLDIIZTANLUXSRO');
        $this->vnp_Url       = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
        $this->vnp_ReturnUrl = route('vnpay.return');
    }

    /**
     * Tạo URL thanh toán VNPay và redirect
     * POST /vnpay/pay
     */
    public function pay(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $productId => $qty) {
            $product = \App\Models\Product::find($productId);
            if ($product) $total += $product->price * $qty;
        }

        // Tạo đơn hàng trạng thái "pending_payment" trước
        $order = Order::create([
            'user_id' => Auth::id(),
            'status'  => 'pending',
            'total'   => $total,
            'note'    => $request->note ?? 'Thanh toán qua VNPay',
        ]);

        // Tạo OrderItems và trừ tồn kho
        foreach ($cart as $productId => $qty) {
            $product = \App\Models\Product::find($productId);
            if ($product) {
                $order->items()->create([
                    'product_id' => $productId,
                    'quantity'   => $qty,
                    'price'      => $product->price,
                ]);
                \App\Models\Product::where('id', $productId)->decrement('quantity', $qty);
            }
        }

        // Xóa giỏ hàng
        session()->forget('cart');

        // ── Tạo tham số VNPay ───────────────────────────────────────
        $vnp_TxnRef  = $order->id . '_' . time(); // Mã giao dịch duy nhất
        $vnp_Amount  = $total * 100;               // VNPay yêu cầu nhân 100
        $vnp_Locale  = 'vn';
        $vnp_IpAddr  = $request->ip();
        $vnp_CreateDate = date('YmdHis');
        $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));

        $inputData = [
            'vnp_Version'    => '2.1.0',
            'vnp_TmnCode'    => $this->vnp_TmnCode,
            'vnp_Amount'     => $vnp_Amount,
            'vnp_Command'    => 'pay',
            'vnp_CreateDate' => $vnp_CreateDate,
            'vnp_CurrCode'   => 'VND',
            'vnp_IpAddr'     => $vnp_IpAddr,
            'vnp_Locale'     => $vnp_Locale,
            'vnp_OrderInfo'  => 'Thanh toan don hang #' . $order->id,
            'vnp_OrderType'  => 'other',
            'vnp_ReturnUrl'  => $this->vnp_ReturnUrl,
            'vnp_TxnRef'     => $vnp_TxnRef,
            'vnp_ExpireDate' => $vnp_ExpireDate,
        ];

        // Sắp xếp theo key và tạo chữ ký
        ksort($inputData);
        $query      = http_build_query($inputData);
        $hashData   = $query;
        $vnpSecureHash = hash_hmac('sha512', $hashData, $this->vnp_HashSecret);

        $paymentUrl = $this->vnp_Url . '?' . $query . '&vnp_SecureHash=' . $vnpSecureHash;

        // Lưu order_id vào session để dùng khi VNPay trả về
        session(['vnpay_order_id' => $order->id]);

        return redirect($paymentUrl);
    }

    /**
     * VNPay redirect về sau khi thanh toán
     * GET /vnpay/return
     */
    public function return(Request $request)
    {
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = $request->except(['vnp_SecureHash', 'vnp_SecureHashType']);

        // Sắp xếp và tạo lại chữ ký để xác minh
        ksort($inputData);
        $hashData = http_build_query($inputData);
        $secureHash = hash_hmac('sha512', $hashData, $this->vnp_HashSecret);

        // Lấy order từ session
        $orderId = session('vnpay_order_id');
        $order   = Order::find($orderId);

        // Xác minh chữ ký
        if ($secureHash !== $vnp_SecureHash) {
            return redirect()->route('orders.index')
                ->with('error', 'Chữ ký không hợp lệ! Giao dịch có thể bị giả mạo.');
        }

        // Kiểm tra kết quả giao dịch
        if ($request->vnp_ResponseCode === '00') {
            // Thanh toán thành công
            if ($order) {
                $order->update(['status' => 'confirmed']);
            }
            session()->forget('vnpay_order_id');
            return redirect()->route('orders.show', $orderId)
                ->with('success', '🎉 Thanh toán VNPay thành công! Mã đơn #' . $orderId);
        } else {
            // Thanh toán thất bại → hủy đơn
            if ($order) {
                $order->update(['status' => 'cancelled']);
            }
            session()->forget('vnpay_order_id');
            return redirect()->route('orders.index')
                ->with('error', 'Thanh toán thất bại hoặc bị hủy. Mã lỗi: ' . $request->vnp_ResponseCode);
        }
    }
}