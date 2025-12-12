<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'H-Dear | Undangan Otomatis')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('undangan.index') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/H-Dear_logo.webp') }}" alt="Logo Aplikasi" class="h-10 w-auto">
                    </a>
                </div>

                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-center sm:space-x-8">
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('undangan.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium h-full transition duration-150 ease-in-out {{ request()->routeIs('undangan.*') ? 'border-indigo-600 text-indigo-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">Buat Undangan (Test)</a>
                            <a href="{{ route('admin.templates.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium h-full transition duration-150 ease-in-out {{ request()->routeIs('admin.*') ? 'border-indigo-600 text-indigo-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">Kelola Template</a>
                        @endif
                    @endauth
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @auth
                        <div class="relative ml-3 flex items-center space-x-4">
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->is_admin ? 'Administrator' : 'Pengguna' }}</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-colors" title="Logout">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('register') }}" class="text-gray-600 hover:text-indigo-600 font-medium px-2 py-2 text-sm transition-colors">
                                Daftar
                            </a>

                            <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-md hover:bg-indigo-700 transition font-medium text-sm shadow-sm">
                                Masuk
                            </a>
                        </div>
                    @endauth
                </div>

                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden sm:hidden bg-white border-t border-gray-100" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('undangan.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('undangan.*') ? 'border-indigo-500 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Buat Undangan (Test)</a>
                        <a href="{{ route('admin.templates.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('admin.*') ? 'border-indigo-500 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">Kelola Template</a>
                    @else
                        <a href="{{ route('undangan.index') }}" class="block pl-3 pr-4 py-2 border-l-4 border-indigo-500 text-indigo-700 bg-indigo-50 text-base font-medium">Beranda</a>
                    @endif
                @else
                    <div class="px-4 py-3 border-b border-gray-100 flex flex-col space-y-2">
                        <a href="{{ route('register') }}" class="block w-full text-center text-gray-600 hover:text-indigo-600 font-medium py-2">
                            Daftar
                        </a>
                        <a href="{{ route('login') }}" class="block w-full text-center bg-indigo-600 text-white font-medium rounded-md py-2 hover:bg-indigo-700 shadow-sm">
                            Masuk
                        </a>
                    </div>
                @endauth
            </div>
            
            @auth
            <div class="pt-4 pb-4 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div>
                        <div class="text-base font-medium text-gray-800">{{ auth()->user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-red-600 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </nav>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded shadow-sm flex justify-between items-center">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3"><p class="text-sm text-green-700">{{ session('success') }}</p></div>
                </div>
            </div>
        </div>
    @endif

    <main class="flex-grow py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-400 text-sm">&copy; {{ date('Y') }} H-Dear Application. Developed with Laravel & ❤️</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>