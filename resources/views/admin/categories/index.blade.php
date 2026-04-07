@extends('admin.layouts.app')

@section('title', 'Quản lý danh mục')
@section('page-title', 'Quản lý danh mục')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-slate-500 text-sm">Tổng cộng: {{ $categories->total() }} danh mục</p>
    <a href="{{ route('admin.categories.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-lg shadow-sm transition text-sm">
        + Thêm danh mục
    </a>
</div>

<!-- Thanh tim kiem -->
<form method="GET" action="{{ route('admin.categories.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-6">
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo tên danh mục..."
                class="w-full border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 outline-none transition">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-semibold px-5 py-2.5 rounded-lg text-sm transition">
                Tìm kiếm
            </button>
            @if(request('search'))
            <a href="{{ route('admin.categories.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-medium px-4 py-2.5 rounded-lg text-sm transition">
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
                    <th class="px-6 py-3">Icon</th>
                    <th class="px-6 py-3">Tên danh mục</th>
                    <th class="px-6 py-3">Slug</th>
                    <th class="px-6 py-3">Số SP</th>
                    <th class="px-6 py-3 text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($categories as $category)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $category->id }}</td>
                    <td class="px-6 py-4 text-2xl">{{ $category->icon }}</td>
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $category->slug }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-slate-100 text-slate-700 px-2.5 py-1 rounded-full text-xs font-semibold">{{ $category->products_count }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs bg-blue-50 px-3 py-1.5 rounded-lg transition">Sửa</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Xóa danh mục này sẽ bỏ liên kết với sản phẩm. Tiếp tục?')">
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
    @if($categories->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection
