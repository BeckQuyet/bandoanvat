@extends('admin.layouts.app')

@section('title', 'Quản lý người dùng')
@section('page-title', 'Quản lý người dùng')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-slate-500 text-sm">Tổng cộng: {{ $users->total() }} người dùng</p>
    <a href="{{ route('admin.users.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-lg shadow-sm transition text-sm">
        + Thêm người dùng
    </a>
</div>

<!-- Thanh tim kiem va loc -->
<form method="GET" action="{{ route('admin.users.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-6">
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo tên hoặc email..."
                class="w-full border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 outline-none transition">
        </div>
        <div>
            <select name="role" class="w-full sm:w-40 border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 outline-none transition bg-white">
                <option value="">Tất cả vai trò</option>
                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-semibold px-5 py-2.5 rounded-lg text-sm transition">
                Tìm kiếm
            </button>
            @if(request('search') || request('role'))
            <a href="{{ route('admin.users.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-medium px-4 py-2.5 rounded-lg text-sm transition">
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
                    <th class="px-6 py-3">Tên</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Vai trò</th>
                    <th class="px-6 py-3">Ngày tạo</th>
                    <th class="px-6 py-3 text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $user->id }}</td>
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        @if($user->role === 'admin')
                            <span class="bg-purple-100 text-purple-700 px-2.5 py-1 rounded-full text-xs font-semibold">Admin</span>
                        @else
                            <span class="bg-slate-100 text-slate-600 px-2.5 py-1 rounded-full text-xs font-semibold">User</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-slate-500">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs bg-blue-50 px-3 py-1.5 rounded-lg transition">Sửa</a>
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Bạn có chắc muốn xóa người dùng này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-xs bg-red-50 px-3 py-1.5 rounded-lg transition">Xóa</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
