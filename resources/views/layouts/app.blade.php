<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Đồ Ăn Vặt Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .product-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .product-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-slate-900 font-bold text-xl tracking-tight flex items-center gap-2">
                            SNACK<span class="text-orange-600">STORE</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-4 text-sm">
                    @auth
                        <span class="text-slate-600 font-medium mr-2">Chào, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-slate-100 hover:bg-slate-200 text-slate-800 px-4 py-2 rounded font-medium transition duration-200 border border-slate-300">Đăng xuất</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-600 hover:text-orange-600 font-medium transition duration-200">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded font-medium shadow-sm transition duration-200">Đăng ký</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white text-slate-500 py-8 mt-auto border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm">
            <p>&copy; 2026 Snack Store. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
