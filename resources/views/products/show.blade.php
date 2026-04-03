@extends('layouts.app')

@section('title', $product->name . ' - Snack Store')

@section('content')
<div class="bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center text-sm text-slate-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-orange-600 transition">Trang chủ</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            @if($product->category)
            <a href="{{ route('home', ['category' => $product->category->slug]) }}" class="hover:text-orange-600 transition">{{ $product->category->name }}</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            @endif
            <span class="text-slate-800 font-medium">{{ $product->name }}</span>
        </nav>

        <!-- Product Detail -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                <!-- Image -->
                <div class="bg-slate-100 aspect-square lg:aspect-auto lg:min-h-[480px] relative overflow-hidden">
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/600x600.png?text=Snack' }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @if($product->category)
                    <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-sm font-semibold text-slate-700 px-3 py-1.5 rounded-full shadow-sm">
                        {{ $product->category->icon }} {{ $product->category->name }}
                    </span>
                    @endif
                </div>

                <!-- Info -->
                <div class="p-8 lg:p-10 flex flex-col">
                    <div class="flex-grow">
                        <h1 class="text-3xl font-extrabold text-slate-900 mb-3">{{ $product->name }}</h1>
                        
                        <div class="flex items-center gap-3 mb-6">
                            <span class="text-3xl font-extrabold text-orange-600">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-2.5 py-1 rounded-full">Còn hàng</span>
                        </div>

                        <div class="border-t border-slate-100 pt-6 mb-6">
                            <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-3">Mô tả sản phẩm</h3>
                            <p class="text-slate-700 leading-relaxed text-base">{{ $product->description }}</p>
                        </div>

                        <!-- Info badges -->
                        <div class="grid grid-cols-2 gap-3 mb-8">
                            <div class="flex items-center gap-2.5 bg-slate-50 rounded-xl p-3 border border-slate-100">
                                <span class="text-xl">🚚</span>
                                <div>
                                    <p class="text-xs font-semibold text-slate-800">Giao nhanh</p>
                                    <p class="text-xs text-slate-500">Trong 30 phút</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 rounded-xl p-3 border border-slate-100">
                                <span class="text-xl">✅</span>
                                <div>
                                    <p class="text-xs font-semibold text-slate-800">Chất lượng</p>
                                    <p class="text-xs text-slate-500">Đảm bảo tươi ngon</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 rounded-xl p-3 border border-slate-100">
                                <span class="text-xl">💰</span>
                                <div>
                                    <p class="text-xs font-semibold text-slate-800">Giá tốt</p>
                                    <p class="text-xs text-slate-500">Giá sinh viên</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2.5 bg-slate-50 rounded-xl p-3 border border-slate-100">
                                <span class="text-xl">🔄</span>
                                <div>
                                    <p class="text-xs font-semibold text-slate-800">Đổi trả</p>
                                    <p class="text-xs text-slate-500">Nếu không hài lòng</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('cart.add', $product->id) }}" class="mb-4">
                        @csrf
                        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-xl shadow-sm transition duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            Thêm vào giỏ hàng
                        </button>
                    </form>

                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 text-orange-600 font-semibold hover:text-orange-700 transition mt-auto">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                        Quay lại trang sản phẩm
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-12">
            <h2 class="text-xl font-bold text-slate-900 mb-6">Sản phẩm cùng danh mục</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <a href="{{ route('product.show', $related->id) }}" class="product-card bg-white rounded-xl overflow-hidden shadow-sm border border-slate-200 flex flex-col hover:border-orange-400 transition-colors duration-300 group">
                    <div class="h-40 overflow-hidden bg-slate-100">
                        <img src="{{ $related->image }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-slate-900 truncate group-hover:text-orange-600 transition">{{ $related->name }}</h3>
                        <span class="text-lg font-bold text-orange-600 mt-1 block">{{ number_format($related->price, 0, ',', '.') }}đ</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
