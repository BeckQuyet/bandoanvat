@extends('admin.layouts.app')

@section('title', 'Quản lý đơn hàng')
@section('page-title', 'Quản lý đơn hàng')

@section('content')
<div class="mb-6">
    <p class="text-slate-500 text-sm">Tổng cộng: {{ $orders->total() }} đơn hàng</p>
</div>

<!-- Thanh tim kiem va loc -->
<form method="GET" action="{{ route('admin.orders.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-6">
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo mã đơn, tên hoặc email khách hàng..."
                class="w-full border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 outline-none transition">
        </div>
        <div>
            <select name="status" class="w-full sm:w-44 border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 outline-none transition bg-white">
                <option value="">Tất cả trạng thái</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                <option value="shipping" {{ request('status') === 'shipping' ? 'selected' : '' }}>Đang giao</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-semibold px-5 py-2.5 rounded-lg text-sm transition">
                Tìm kiếm
            </button>
            @if(request('search') || request('status'))
            <a href="{{ route('admin.orders.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-medium px-4 py-2.5 rounded-lg text-sm transition">
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
                    <th class="px-6 py-3">Mã ĐH</th>
                    <th class="px-6 py-3">Khách hàng</th>
                    <th class="px-6 py-3">Tổng tiền</th>
                    <th class="px-6 py-3">Trạng thái</th>
                    <th class="px-6 py-3">Ngày đặt</th>
                    <th class="px-6 py-3 text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($orders as $order)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-semibold text-slate-800">#{{ $order->id }}</td>
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-medium text-slate-800">{{ $order->user->name ?? 'N/A' }}</p>
                            <p class="text-xs text-slate-400">{{ $order->user->email ?? '' }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-semibold text-slate-800">{{ number_format($order->total, 0, ',', '.') }}đ</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $order->status_color }}">
                            {{ $order->status_label }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-500">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs bg-blue-50 px-3 py-1.5 rounded-lg transition">Chi tiết</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-400">Chưa có đơn hàng nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-slate-100">
        {{ $orders->links() }}
    </div>
</div>
@endsection
