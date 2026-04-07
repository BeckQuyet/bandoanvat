@extends('admin.layouts.app')

@section('title', isset($product) ? 'Sửa sản phẩm' : 'Thêm sản phẩm')
@section('page-title', isset($product) ? 'Sửa sản phẩm' : 'Thêm sản phẩm')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6">
            @if ($errors->any())
            <div class="bg-red-50 text-red-600 rounded-lg p-4 mb-6 border border-red-200 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li class="font-medium">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}">
                @csrf
                @if(isset($product)) @method('PUT') @endif

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tên sản phẩm</label>
                        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-slate-50 focus:bg-white transition" placeholder="Nhập tên sản phẩm">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Danh mục</label>
                        <select name="category_id" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-slate-50 focus:bg-white transition">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Giá (VNĐ)</label>
                        <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" required min="0" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-slate-50 focus:bg-white transition" placeholder="VD: 25000">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Link hình ảnh</label>
                        <input type="url" name="image" value="{{ old('image', $product->image ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-slate-50 focus:bg-white transition" placeholder="https://example.com/image.jpg">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Mô tả</label>
                        <textarea name="description" rows="4" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-slate-50 focus:bg-white transition" placeholder="Mô tả chi tiết sản phẩm">{{ old('description', $product->description ?? '') }}</textarea>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition">
                            {{ isset($product) ? 'Cập nhật' : 'Thêm mới' }}
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="text-slate-500 hover:text-slate-700 font-medium py-2.5 px-4 transition">Hủy</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
