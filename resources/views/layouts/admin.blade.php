<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - MOZU')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>
        
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-gray-800 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">
            <div class="p-4 border-b border-gray-700 flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold flex items-center">
                    <i class="fas fa-corn mr-2"></i> MOZU Admin
                </a>
                <!-- Close button for mobile -->
                <button id="close-sidebar" class="lg:hidden text-white hover:text-gray-300">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <nav class="mt-4 pb-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 border-l-4 border-orange-500' : '' }}">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.products.*') ? 'bg-gray-700 border-l-4 border-orange-500' : '' }}">
                    <i class="fas fa-box w-5"></i>
                    <span class="ml-3">Produk</span>
                </a>
                
                <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.orders.*') ? 'bg-gray-700 border-l-4 border-orange-500' : '' }}">
                    <i class="fas fa-shopping-bag w-5"></i>
                    <span class="ml-3">Pesanan</span>
                </a>
                
                <a href="{{ route('admin.reports') }}" class="flex items-center px-4 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.reports') ? 'bg-gray-700 border-l-4 border-orange-500' : '' }}">
                    <i class="fas fa-file-alt w-5"></i>
                    <span class="ml-3">Laporan</span>
                </a>
                
                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.settings.*') ? 'bg-gray-700 border-l-4 border-orange-500' : '' }}">
                    <i class="fas fa-cog w-5"></i>
                    <span class="ml-3">Pengaturan</span>
                </a>
                
                <div class="border-t border-gray-700 mt-4 pt-4">
                    <a href="{{ route('home') }}" class="flex items-center px-4 py-3 hover:bg-gray-700">
                        <i class="fas fa-home w-5"></i>
                        <span class="ml-3">Ke Website</span>
                    </a>
                </div>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden w-full lg:w-auto">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm z-30">
                <div class="flex items-center justify-between px-4 lg:px-6 py-3 lg:py-4">
                    <div class="flex items-center space-x-3">
                        <!-- Hamburger Menu Button -->
                        <button id="mobile-menu-button" class="lg:hidden text-gray-800 hover:text-orange-600 focus:outline-none">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-lg lg:text-2xl font-bold text-gray-800 truncate">@yield('page-title')</h1>
                    </div>
                    
                    <div class="flex items-center space-x-2 lg:space-x-4">
                        <span class="text-sm lg:text-base text-gray-700 hidden sm:inline">{{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-700 text-sm lg:text-base">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="hidden sm:inline ml-1">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mx-6 mt-4">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-6 mt-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                </div>
            @endif
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- JavaScript for Mobile Menu -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const closeSidebar = document.getElementById('close-sidebar');
        const overlay = document.getElementById('mobile-menu-overlay');

        // Open sidebar
        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });

        // Close sidebar
        const closeSidebarFunc = () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        };

        closeSidebar.addEventListener('click', closeSidebarFunc);
        overlay.addEventListener('click', closeSidebarFunc);

        // Close sidebar when clicking menu item on mobile
        const menuLinks = sidebar.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) { // lg breakpoint
                    setTimeout(closeSidebarFunc, 100);
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>

