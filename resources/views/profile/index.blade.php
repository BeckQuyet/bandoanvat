@extends('layouts.app')

@section('title', 'Tài khoản - Snack Store')

@section('content')
<div class="bg-slate-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold text-slate-900 mb-8">Tài khoản cá nhân</h1>

        @if(session('success'))
        <div class="bg-green-50 text-green-700 rounded-lg p-4 mb-6 border border-green-200 text-sm font-medium">
            {{ session('success') }}
        </div>
        @endif

        <!-- Thong tin tai khoan -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6">
            <div class="p-6 border-b border-slate-100">
                <h2 class="text-lg font-semibold text-slate-900">Thông tin tài khoản</h2>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-500 mb-1">Họ và tên</label>
                    <p class="text-base font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-500 mb-1">Email</label>
                    <p class="text-base font-semibold text-slate-900">{{ Auth::user()->email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-500 mb-1">Ngày tham gia</label>
                    <p class="text-base font-semibold text-slate-900">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Doi mat khau -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h2 class="text-lg font-semibold text-slate-900">Đổi mật khẩu</h2>
            </div>
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

                <form method="POST" action="{{ route('profile.password') }}" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="current_password" class="block text-sm font-semibold text-slate-700 mb-1.5">Mật khẩu hiện tại</label>
                        <input id="current_password" name="current_password" type="password" required 
                            class="appearance-none rounded-lg block w-full px-3.5 py-2.5 border border-slate-300 placeholder-slate-400 text-slate-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-slate-50 focus:bg-white transition" 
                            placeholder="Nhập mật khẩu hiện tại">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Mật khẩu mới</label>
                        <input id="password" name="password" type="password" required 
                            class="appearance-none rounded-lg block w-full px-3.5 py-2.5 border border-slate-300 placeholder-slate-400 text-slate-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-slate-50 focus:bg-white transition" 
                            placeholder="Nhập mật khẩu mới (ít nhất 6 ký tự)">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Xác nhận mật khẩu mới</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                            class="appearance-none rounded-lg block w-full px-3.5 py-2.5 border border-slate-300 placeholder-slate-400 text-slate-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-slate-50 focus:bg-white transition" 
                            placeholder="Nhập lại mật khẩu mới">
                    </div>
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition duration-200">
                        Cập nhật mật khẩu
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
