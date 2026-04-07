@extends('layouts.app')

@section('title', isset($currentCategory) ? $currentCategory->name . ' - Snack Store' : 'Trang Chủ - Snack Store')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-orange-500 via-orange-400 to-amber-400 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-10 -right-10 w-72 h-72 bg-white rounded-full"></div>
        <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-white rounded-full"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 relative">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="text-center md:text-left max-w-xl">
                <div class="inline-flex items-center bg-white/20 backdrop-blur-sm rounded-full px-4 py-1.5 mb-5">
                    <span class="text-white text-sm font-semibold">Freeship đơn từ 50k</span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-tight mb-4">
                    Đồ ăn vặt<br><span class="text-yellow-200">ngon khó cưỡng!</span>
                </h1>
                <p class="text-lg text-orange-100 font-medium mb-8 leading-relaxed">
                    Hàng trăm món ăn vặt từ truyền thống đến hiện đại. Giá sinh viên, giao nhanh, chất lượng đảm bảo.
                </p>
                <a href="#products" class="inline-flex items-center bg-white text-orange-600 font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl hover:bg-orange-50 transition duration-300">
                    Khám phá ngay
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Category Chips -->
<div class="bg-white border-b border-slate-200 sticky top-16 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <div class="flex flex-col sm:flex-row items-center gap-3">
            <div class="flex items-center gap-2 overflow-x-auto scrollbar-hide pb-1 flex-1">
                <a href="{{ route('home') }}" 
                   class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold transition duration-200 border
                   {{ !isset($currentCategory) && !request('search') ? 'bg-orange-500 text-white border-orange-500 shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:border-orange-300 hover:text-orange-600 hover:bg-orange-50' }}">
                    Tất cả
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('home', ['category' => $cat->slug]) }}" 
                   class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold transition duration-200 border
                   {{ (isset($currentCategory) && $currentCategory->id === $cat->id) ? 'bg-orange-500 text-white border-orange-500 shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:border-orange-300 hover:text-orange-600 hover:bg-orange-50' }}">
                    {{ $cat->name }}
                </a>
                @endforeach
            </div>
            <form method="GET" action="{{ route('home') }}" class="flex gap-2 shrink-0">
                @if(isset($currentCategory))
                <input type="hidden" name="category" value="{{ $currentCategory->slug }}">
                @endif
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm sản phẩm..."
                    class="w-48 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 outline-none transition">
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-2 rounded-lg text-sm font-semibold transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Products Section -->
<div id="products" class="bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">
                    @if(isset($currentCategory))
                        {{ $currentCategory->name }}
                    @else
                        Tất cả sản phẩm
                    @endif
                </h2>
                <p class="text-slate-500 text-sm mt-1">{{ $products->total() }} sản phẩm</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
            <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm border border-slate-200 relative flex flex-col h-full hover:border-orange-400 transition-colors duration-300 group">
                <a href="{{ route('product.show', $product->id) }}" class="block">
                    <div class="h-48 overflow-hidden bg-slate-100 relative">
                        <img src="{{ $product->image ?? 'https://via.placeholder.com/400x300.png?text=Snack' }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        @if($product->category)
                        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-xs font-semibold text-slate-700 px-2.5 py-1 rounded-full shadow-sm">
                            {{ $product->category->name }}
                        </span>
                        @endif
                    </div>
                
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-base font-semibold text-slate-900 mb-1 truncate group-hover:text-orange-600 transition" title="{{ $product->name }}">{{ $product->name }}</h3>
                        <p class="text-slate-500 text-sm mb-4 line-clamp-2 min-h-[40px] leading-relaxed">{{ $product->description }}</p>
                    </div>
                </a>
                    
                <div class="px-5 pb-5 mt-auto flex items-center justify-between pt-4 border-t border-slate-100">
                    <span class="text-xl font-bold text-orange-600">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                    @if($product->quantity > 0)
                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                        @csrf
                        <button type="submit" class="bg-orange-50 text-orange-600 hover:bg-orange-600 hover:text-white border border-orange-200 hover:border-orange-600 p-2 rounded-lg shadow-sm transition duration-200" title="Thêm vào giỏ">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                            </svg>
                        </button>
                    </form>
                    @else
                    <span class="bg-red-100 text-red-600 text-xs font-semibold px-3 py-1.5 rounded-lg">Hết hàng</span>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full py-16 text-center text-slate-500 border-2 border-dashed border-slate-200 rounded-xl bg-white">
                <svg class="mx-auto h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <p class="text-base font-medium">Hiện chưa có sản phẩm nào trong danh mục này.</p>
                <a href="{{ route('home') }}" class="inline-block mt-4 text-orange-600 font-semibold hover:underline">← Xem tất cả sản phẩm</a>
            </div>
            @endforelse
        </div>

        @if($products->hasPages())
        <div class="mt-8">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
