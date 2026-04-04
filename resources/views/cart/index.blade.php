@extends('layouts.app')

@section('title', 'Giỏ hàng - Snack Store')

@section('content')
<div class="bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold text-slate-900 mb-8">Giỏ hàng của bạn</h1>

        @if(session('success'))
        <div class="bg-green-50 text-green-700 rounded-lg p-4 mb-6 border border-green-200 text-sm font-medium">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-50 text-red-600 rounded-lg p-4 mb-6 border border-red-200 text-sm font-medium">
            {{ session('error') }}
        </div>
        @endif

        @if(count($items) > 0)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="divide-y divide-slate-100">
                @foreach($items as $item)
                <div class="flex items-center gap-4 p-5">
                    <img src="{{ $item['product']->image }}" alt="{{ $item['product']->name }}" class="w-20 h-20 object-cover rounded-lg border border-slate-200 shrink-0">
                    
                    <div class="flex-grow min-w-0">
                        <a href="{{ route('product.show', $item['product']->id) }}" class="text-base font-semibold text-slate-900 hover:text-orange-600 transition truncate block">{{ $item['product']->name }}</a>
                        <p class="text-orange-600 font-bold mt-0.5">{{ number_format($item['product']->price, 0, ',', '.') }}đ</p>
                    </div>

                    <form method="POST" action="{{ route('cart.update', $item['product']->id) }}" class="flex items-center gap-2 shrink-0">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99" 
                            class="w-16 text-center border border-slate-300 rounded-lg py-1.5 text-sm focus:ring-orange-500 focus:border-orange-500"
                            onchange="this.form.submit()">
                    </form>

                    <span class="text-base font-bold text-slate-800 w-28 text-right shrink-0">{{ number_format($item['subtotal'], 0, ',', '.') }}đ</span>

                    <form method="POST" action="{{ route('cart.remove', $item['product']->id) }}" class="shrink-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-slate-400 hover:text-red-500 transition p-1" title="Xóa">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>

            <!-- Total + Checkout -->
            <div class="bg-slate-50 p-5 border-t border-slate-200">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-lg font-semibold text-slate-700">Tổng cộng:</span>
                    <span class="text-2xl font-extrabold text-orange-600">{{ number_format($total, 0, ',', '.') }}đ</span>
                </div>
                
                @auth
                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf
                    <textarea name="note" rows="2" placeholder="Ghi chú cho đơn hàng (tùy chọn)..." 
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm mb-3 focus:ring-orange-500 focus:border-orange-500 resize-none"></textarea>
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-xl shadow-sm transition duration-200">
                        Đặt hàng
                    </button>
                </form>
                @else
                <div class="text-center">
                    <p class="text-slate-500 text-sm mb-3">Vui lòng đăng nhập để đặt hàng</p>
                    <a href="{{ route('login') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl shadow-sm transition duration-200">Đăng nhập</a>
                </div>
                @endauth
            </div>
        </div>
        @else
        <div class="text-center py-20 bg-white rounded-xl border-2 border-dashed border-slate-200">
            <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <p class="text-lg font-semibold text-slate-600 mb-2">Giỏ hàng trống</p>
            <p class="text-slate-500 text-sm mb-6">Hãy thêm sản phẩm yêu thích vào giỏ hàng nhé!</p>
            <a href="{{ route('home') }}" class="inline-flex items-center bg-orange-500 hover:bg-orange-600 text-white font-bold px-6 py-3 rounded-xl shadow-sm transition">
                Mua sắm ngay
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
