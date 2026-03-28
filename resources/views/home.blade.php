@extends('layouts.app')

@section('title', 'Sản Phẩm - Snack Store')

@section('content')
<div class="bg-gradient-to-br from-amber-50 to-orange-100 border-b border-orange-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="text-center md:text-left">
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight sm:text-5xl lg:text-6xl mb-6 shadow-sm-text">
                Chất lượng <span class="text-orange-600 block sm:inline">hàng đầu</span>
            </h1>
            <p class="mt-4 max-w-2xl text-lg text-slate-700 font-medium">
                Lựa chọn những sản phẩm ăn vặt tốt nhất với giá cả hợp lý. Giao hàng nhanh gọn, tiện lợi.
            </p>
        </div>
    </div>
</div>

<div class="bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-slate-800">
        <div class="flex items-center space-x-2 mb-8 border-b border-slate-200 pb-4">
            <h2 class="text-2xl font-bold">Danh Sách Sản Phẩm</h2>
            <span class="bg-orange-100 text-orange-800 py-1 px-3 rounded-full text-xs font-semibold border border-orange-200">{{ count($products) }} Món</span>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
            <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm border border-slate-200 relative flex flex-col h-full hover:border-orange-400 transition-colors duration-300">
                <div class="h-48 overflow-hidden bg-slate-100 relative group">
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/400x300.png?text=Bim+Bim' }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-slate-900 bg-opacity-0 group-hover:bg-opacity-10 transition-opacity duration-300"></div>
                </div>
                
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-semibold text-slate-900 mb-1 line-clamp-1 truncate" title="{{ $product->name }}">{{ $product->name }}</h3>
                    <p class="text-slate-500 text-sm mb-4 line-clamp-2 min-h-[40px] leading-relaxed">{{ $product->description }}</p>
                    
                    <div class="mt-auto flex items-center justify-between pt-4 border-t border-slate-100">
                        <span class="text-xl font-bold text-orange-600">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                        <button class="bg-orange-50 text-orange-600 hover:bg-orange-600 focus:bg-orange-700 hover:text-white border border-orange-200 hover:border-orange-600 p-2 rounded-lg shadow-sm transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-16 text-center text-slate-500 border-2 border-dashed border-slate-200 rounded-xl bg-white">
                <svg class="mx-auto h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <p class="text-base font-medium">Hiện chưa có sản phẩm nào.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
