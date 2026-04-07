@extends('admin.layouts.app')

@section('title', isset($category) ? 'Sửa danh mục' : 'Thêm danh mục')
@section('page-title', isset($category) ? 'Sửa danh mục' : 'Thêm danh mục')

@section('content')
<div class="max-w-lg">
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

            <form method="POST" action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
                @csrf
                @if(isset($category)) @method('PUT') @endif

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tên danh mục</label>
                        <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-slate-50 focus:bg-white transition" placeholder="VD: Đồ chiên & Nướng">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Icon (emoji)</label>
                        <input type="text" name="icon" value="{{ old('icon', $category->icon ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-slate-50 focus:bg-white transition" placeholder="VD: 🍗">
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition">
                            {{ isset($category) ? 'Cập nhật' : 'Thêm mới' }}
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="text-slate-500 hover:text-slate-700 font-medium py-2.5 px-4 transition">Hủy</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
