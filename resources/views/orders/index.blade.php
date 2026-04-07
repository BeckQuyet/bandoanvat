@extends('layouts.app')

@section('title', 'Đơn hàng của tôi - Snack Store')

@section('content')
<div class="bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold text-slate-900 mb-6">Đơn hàng của tôi</h1>

        <!-- Loc trang thai -->
        <form method="GET" action="{{ route('orders.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-6">
            <div class="flex flex-col sm:flex-row gap-3">
                <div>
                    <select name="status" class="w-full sm:w-48 border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 outline-none transition bg-white">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                        <option value="shipping" {{ request('status') === 'shipping' ? 'selected' : '' }}>Đang giao</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-semibold px-5 py-2.5 rounded-lg text-sm transition">
                        Lọc
                    </button>
                    @if(request('status'))
                    <a href="{{ route('orders.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-medium px-4 py-2.5 rounded-lg text-sm transition">
                        Xóa lọc
                    </a>
                    @endif
                </div>
            </div>
        </form>

        @if(session('success'))
        <div class="bg-green-50 text-green-700 rounded-lg p-4 mb-6 border border-green-200 text-sm font-medium">
            {{ session('success') }}
        </div>
        @endif

        @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
            <a href="{{ route('orders.show', $order->id) }}" class="block bg-white rounded-xl shadow-sm border border-slate-200 hover:border-orange-300 transition p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <span class="text-base font-bold text-slate-900">Đơn #{{ $order->id }}</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $order->status_color }}">{{ $order->status_label }}</span>
                    </div>
                    <span class="text-sm text-slate-500">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                </div>

                <div class="flex items-center gap-2 mb-2">
                    @foreach($order->items->take(4) as $item)
                    <img src="{{ $item->product->image ?? '' }}" alt="" class="w-10 h-10 object-cover rounded-lg border border-slate-200">
                    @endforeach
                    @if($order->items->count() > 4)
                    <span class="text-xs text-slate-500 font-medium">+{{ $order->items->count() - 4 }} sản phẩm</span>
                    @endif
                </div>

                <div class="flex items-center justify-between pt-2 border-t border-slate-100">
                    <span class="text-sm text-slate-500">{{ $order->items->count() }} sản phẩm</span>
                    <span class="text-lg font-bold text-orange-600">{{ number_format($order->total, 0, ',', '.') }}đ</span>
                </div>
            </a>
            @endforeach
        </div>

        @if($orders->hasPages())
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
        @endif
        @else
        <div class="text-center py-20 bg-white rounded-xl border-2 border-dashed border-slate-200">
            <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="text-lg font-semibold text-slate-600 mb-2">Chưa có đơn hàng nào</p>
            <p class="text-slate-500 text-sm mb-6">Hãy mua sắm và đặt đơn hàng đầu tiên nhé!</p>
            <a href="{{ route('home') }}" class="inline-flex items-center bg-orange-500 hover:bg-orange-600 text-white font-bold px-6 py-3 rounded-xl shadow-sm transition">
                Mua sắm ngay
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
