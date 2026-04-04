@extends('layouts.app')

@section('title', 'Đơn hàng #' . $order->id . ' - Snack Store')

@section('content')
<div class="bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center text-sm text-slate-500 mb-8">
            <a href="{{ route('orders.index') }}" class="hover:text-orange-600 transition">Đơn hàng của tôi</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-800 font-medium">Đơn #{{ $order->id }}</span>
        </nav>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <!-- Header -->
            <div class="p-6 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-bold text-slate-900">Đơn hàng #{{ $order->id }}</h1>
                        <p class="text-sm text-slate-500 mt-1">Đặt lúc {{ $order->created_at->format('H:i - d/m/Y') }}</p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                        @switch($order->status_color)
                            @case('yellow') bg-yellow-100 text-yellow-800 @break
                            @case('blue') bg-blue-100 text-blue-800 @break
                            @case('indigo') bg-indigo-100 text-indigo-800 @break
                            @case('green') bg-green-100 text-green-800 @break
                            @case('red') bg-red-100 text-red-800 @break
                            @default bg-slate-100 text-slate-800
                        @endswitch
                    ">{{ $order->status_label }}</span>
                </div>
            </div>

            <!-- Items -->
            <div class="divide-y divide-slate-100">
                @foreach($order->items as $item)
                <div class="flex items-center gap-4 p-5">
                    <img src="{{ $item->product->image ?? '' }}" alt="{{ $item->product->name ?? '' }}" class="w-16 h-16 object-cover rounded-lg border border-slate-200 shrink-0">
                    <div class="flex-grow min-w-0">
                        <p class="text-base font-semibold text-slate-900 truncate">{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</p>
                        <p class="text-sm text-slate-500">{{ number_format($item->price, 0, ',', '.') }}đ x {{ $item->quantity }}</p>
                    </div>
                    <span class="text-base font-bold text-slate-800 shrink-0">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</span>
                </div>
                @endforeach
            </div>

            <!-- Note -->
            @if($order->note)
            <div class="px-5 py-4 bg-amber-50 border-t border-amber-100">
                <p class="text-sm text-amber-800"><span class="font-semibold">Ghi chú:</span> {{ $order->note }}</p>
            </div>
            @endif

            <!-- Total -->
            <div class="bg-slate-50 p-5 border-t border-slate-200">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-semibold text-slate-700">Tổng cộng:</span>
                    <span class="text-2xl font-extrabold text-orange-600">{{ number_format($order->total, 0, ',', '.') }}đ</span>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-2 text-orange-600 font-semibold hover:text-orange-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                Quay lại danh sách đơn hàng
            </a>
        </div>
    </div>
</div>
@endsection
