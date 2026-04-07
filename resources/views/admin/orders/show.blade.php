@extends('admin.layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->id)
@section('page-title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Order Info -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Items -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-base font-bold text-slate-900">Danh sách sản phẩm</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
                        <tr>
                            <th class="px-6 py-3 text-left">Sản phẩm</th>
                            <th class="px-6 py-3 text-center">SL</th>
                            <th class="px-6 py-3 text-right">Đơn giá</th>
                            <th class="px-6 py-3 text-right">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($order->items as $item)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $item->product->image ?? 'https://via.placeholder.com/48' }}" class="w-10 h-10 rounded-lg object-cover bg-slate-100">
                                    <span class="font-medium text-slate-800">{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center text-slate-600">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 text-right text-slate-600">{{ number_format($item->price, 0, ',', '.') }}đ</td>
                            <td class="px-6 py-4 text-right font-semibold text-slate-800">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-slate-50">
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-bold text-slate-800">Tổng cộng:</td>
                            <td class="px-6 py-4 text-right font-extrabold text-orange-600 text-lg">{{ number_format($order->total, 0, ',', '.') }}đ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Note -->
        @if($order->note)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-base font-bold text-slate-900 mb-2">Ghi chú khách hàng</h3>
            <p class="text-slate-600 text-sm">{{ $order->note }}</p>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Customer Info -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-base font-bold text-slate-900 mb-4">Thông tin khách hàng</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="text-slate-500">Họ tên:</span>
                    <span class="font-semibold text-slate-800 ml-1">{{ $order->user->name ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="text-slate-500">Email:</span>
                    <span class="font-semibold text-slate-800 ml-1">{{ $order->user->email ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="text-slate-500">Ngày đặt:</span>
                    <span class="font-semibold text-slate-800 ml-1">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Update Status -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-base font-bold text-slate-900 mb-4">Cập nhật trạng thái</h3>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $order->status_color }} mb-4">
                {{ $order->status_label }}
            </span>
            <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}">
                @csrf
                @method('PATCH')
                <select name="status" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm mb-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                    <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                    <option value="shipping" {{ $order->status === 'shipping' ? 'selected' : '' }}>Đang giao</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                </select>
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded-lg shadow-sm transition text-sm">
                    Cập nhật
                </button>
            </form>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 text-orange-600 font-semibold hover:text-orange-700 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
            Quay lại danh sách
        </a>
    </div>
</div>
@endsection
