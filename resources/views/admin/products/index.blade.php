@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')
@section('page-title', 'Quản lý sản phẩm')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-slate-500 text-sm">Tổng cộng: {{ $products->total() }} sản phẩm</p>
    <a href="{{ route('admin.products.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-lg shadow-sm transition text-sm">
        + Thêm sản phẩm
    </a>
</div>

<!-- Thanh tim kiem va loc -->
<form method="GET" action="{{ route('admin.products.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-6">
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo tên sản phẩm..."
                class="w-full border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 outline-none transition">
        </div>
        <div>
            <select name="category_id" class="w-full sm:w-48 border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 outline-none transition bg-white">
                <option value="">Tất cả danh mục</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-semibold px-5 py-2.5 rounded-lg text-sm transition">
                Tìm kiếm
            </button>
            @if(request('search') || request('category_id'))
            <a href="{{ route('admin.products.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-medium px-4 py-2.5 rounded-lg text-sm transition">
                Xóa lọc
            </a>
            @endif
        </div>
    </div>
</form>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Hình ảnh</th>
                    <th class="px-6 py-3">Tên sản phẩm</th>
                    <th class="px-6 py-3">Danh mục</th>
                    <th class="px-6 py-3">Giá</th>
                    <th class="px-6 py-3">Tồn kho</th>
                    <th class="px-6 py-3 text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($products as $product)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $product->id }}</td>
                    <td class="px-6 py-4">
                        <img src="{{ $product->image ?? 'https://via.placeholder.com/60' }}" alt="" class="w-12 h-12 rounded-lg object-cover bg-slate-100">
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $product->category->name ?? '-' }}</td>
                    <td class="px-6 py-4 font-semibold text-orange-600">{{ number_format($product->price, 0, ',', '.') }}đ</td>
                    <td class="px-6 py-4">
                        @if($product->quantity > 0)
                            <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-semibold">{{ $product->quantity }}</span>
                        @else
                            <span class="bg-red-100 text-red-600 px-2.5 py-1 rounded-full text-xs font-semibold">Hết hàng</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs bg-blue-50 px-3 py-1.5 rounded-lg transition">Sửa</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-xs bg-red-50 px-3 py-1.5 rounded-lg transition">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-slate-100">
        {{ $products->links() }}
    </div>
</div>
@endsection
