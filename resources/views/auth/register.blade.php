@extends('layouts.app')

@section('title', 'Đăng Ký - Snack Store')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-144px)] px-4 py-12 bg-slate-50">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
            <!-- Header -->
            <div class="bg-white border-b border-slate-100 text-center py-6 px-4">
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Tạo Tài Khoản Mới</h2>
                <p class="text-slate-500 mt-1 text-sm font-medium">Điền thông tin để đăng ký thành viên.</p>
            </div>
            
            <div class="p-8">
                @if ($errors->any())
                    <div class="bg-red-50 text-red-600 rounded-lg p-4 mb-6 border border-red-200 text-sm">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li class="font-medium">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Họ và tên</label>
                        <input id="name" name="name" type="text" required value="{{ old('name') }}"
                            class="appearance-none rounded-lg relative block w-full px-3.5 py-2.5 border border-slate-300 placeholder-slate-400 text-slate-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-slate-50 focus:bg-white transition duration-200" 
                            placeholder="Nguyễn Văn A">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Địa chỉ Email</label>
                        <input id="email" name="email" type="email" required value="{{ old('email') }}"
                            class="appearance-none rounded-lg relative block w-full px-3.5 py-2.5 border border-slate-300 placeholder-slate-400 text-slate-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-slate-50 focus:bg-white transition duration-200" 
                            placeholder="mail@example.com">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Mật khẩu</label>
                        <input id="password" name="password" type="password" required 
                            class="appearance-none rounded-lg relative block w-full px-3.5 py-2.5 border border-slate-300 placeholder-slate-400 text-slate-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-slate-50 focus:bg-white transition duration-200" 
                            placeholder="********">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Xác nhận mật khẩu</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                            class="appearance-none rounded-lg relative block w-full px-3.5 py-2.5 border border-slate-300 placeholder-slate-400 text-slate-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-slate-50 focus:bg-white transition duration-200" 
                            placeholder="********">
                    </div>

                    <div class="pt-2">
                        <button type="submit" 
                            class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-200 shadow-sm">
                            Đăng ký
                        </button>
                    </div>
                </form>
                
                <div class="mt-8 text-center text-sm border-t border-slate-100 pt-6">
                    <p class="text-slate-600 font-medium">
                        Đã có tài khoản? 
                        <a href="{{ route('login') }}" class="font-bold text-orange-600 hover:text-orange-700 transition">Đăng nhập ngay</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
