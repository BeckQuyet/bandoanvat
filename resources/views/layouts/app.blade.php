<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Đồ Ăn Vặt Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .product-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .product-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
        .nav-link { position: relative; }
        .nav-link::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 2px; background-color: #ea580c; transition: width 0.3s; }
        .nav-link:hover::after { width: 100%; }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo + Nav Links -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-slate-900 font-extrabold text-xl tracking-tight flex items-center gap-1.5">
                        <span class="text-2xl">🍿</span>
                        SNACK<span class="text-orange-600">STORE</span>
                    </a>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('home') }}" class="nav-link text-sm font-medium text-slate-600 hover:text-orange-600 px-3 py-2 rounded-lg hover:bg-orange-50 transition">Trang chủ</a>
                        @php $navCategories = \App\Models\Category::all(); @endphp
                        <div class="relative group">
                            <button class="nav-link text-sm font-medium text-slate-600 hover:text-orange-600 px-3 py-2 rounded-lg hover:bg-orange-50 transition flex items-center gap-1">
                                Danh mục
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="absolute left-0 top-full mt-1 w-56 bg-white rounded-xl shadow-lg border border-slate-200 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="{{ route('home') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 hover:bg-orange-50 hover:text-orange-600 transition">
                                    Tất cả sản phẩm
                                </a>
                                @foreach($navCategories as $cat)
                                <a href="{{ route('home', ['category' => $cat->slug]) }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 hover:bg-orange-50 hover:text-orange-600 transition">
                                    {{ $cat->name }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Auth + Cart -->
                <div class="flex items-center space-x-3 text-sm">
                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="relative text-slate-600 hover:text-orange-600 transition p-2 rounded-lg hover:bg-orange-50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                        @php $cartCount = count(session('cart', [])); @endphp
                        @if($cartCount > 0)
                        <span class="absolute -top-0.5 -right-0.5 bg-orange-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
                        @endif
                    </a>

                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-1.5 text-slate-600 hover:text-orange-600 font-medium px-3 py-2 rounded-lg hover:bg-orange-50 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="absolute right-0 top-full mt-1 w-48 bg-white rounded-xl shadow-lg border border-slate-200 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="{{ route('profile.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 hover:bg-orange-50 hover:text-orange-600 transition">Tài khoản</a>
                                <a href="{{ route('orders.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 hover:bg-orange-50 hover:text-orange-600 transition">Đơn hàng</a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center gap-2.5 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">Đăng xuất</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-600 hover:text-orange-600 font-medium transition duration-200 px-3 py-2">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-semibold shadow-sm transition duration-200">Đăng ký</a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden border-t border-slate-100 px-4 pb-3 pt-2">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('home') }}" class="text-xs font-medium text-slate-600 bg-slate-100 hover:bg-orange-100 hover:text-orange-600 px-3 py-1.5 rounded-full transition">Trang chủ</a>
                @foreach($navCategories as $cat)
                <a href="{{ route('home', ['category' => $cat->slug]) }}" class="text-xs font-medium text-slate-600 bg-slate-100 hover:bg-orange-100 hover:text-orange-600 px-3 py-1.5 rounded-full transition">{{ $cat->name }}</a>
                @endforeach
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Brand -->
                <div>
                    <a href="{{ route('home') }}" class="text-white font-extrabold text-xl flex items-center gap-1.5 mb-4">
                        <span class="text-2xl">🍿</span> SNACK<span class="text-orange-500">STORE</span>
                    </a>
                    <p class="text-sm leading-relaxed">Chuyên cung cấp đồ ăn vặt chất lượng, giá sinh viên. Giao hàng nhanh gọn, tiện lợi trong khu vực.</p>
                </div>
                <!-- Danh muc -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Danh mục</h4>
                    <ul class="space-y-2 text-sm">
                        @foreach($navCategories as $cat)
                        <li><a href="{{ route('home', ['category' => $cat->slug]) }}" class="hover:text-orange-400 transition">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- Lien he -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Liên hệ</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center gap-2">📍 123 Hà Nội</li>
                        <li class="flex items-center gap-2">📞 0909 123 456</li>
                        <li class="flex items-center gap-2">✉️ contact@mail.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 mt-8 pt-6 text-center text-xs">
                <p>&copy; Quyết và Tuấn.</p>
            </div>
        </div>
    </footer>
</body>
</html>
