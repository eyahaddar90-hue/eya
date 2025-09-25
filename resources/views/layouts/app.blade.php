<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TaskFlow') }} - Gestion moderne des tâches</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>📋</text></svg>">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="h-full bg-neutral-50 font-sans antialiased" x-data="{ sidebarOpen: false }">
        <div class="min-h-full">
            <!-- Sidebar mobile overlay -->
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 flex z-40 md:hidden">
                <div class="fixed inset-0 bg-neutral-600 bg-opacity-75" @click="sidebarOpen = false"></div>
            </div>

            <!-- Sidebar -->
            <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
                <div class="flex flex-col flex-grow pt-5 bg-white overflow-y-auto border-r border-neutral-200">
                    <!-- Logo -->
                    <div class="flex items-center flex-shrink-0 px-6">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h1 class="ml-3 text-xl font-bold text-neutral-900">TaskFlow</h1>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="mt-8 flex-1 px-4 space-y-1">
                        <a href="{{ route('dashboard') }}" 
                           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            </svg>
                            Tableau de bord
                        </a>

                        <a href="{{ route('tasks.index') }}" 
                           class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            Mes tâches
                        </a>

                        <a href="{{ route('teams.index') }}" 
                           class="nav-link {{ request()->routeIs('teams.*') ? 'active' : '' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Équipes
                        </a>
                    </nav>

                    <!-- User menu -->
                    <div class="flex-shrink-0 flex border-t border-neutral-200 p-4">
                        <div class="flex items-center w-full" x-data="{ open: false }">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-white">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-neutral-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-neutral-500">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="relative">
                                <button @click="open = !open" class="p-1 rounded-full hover:bg-neutral-100 transition-colors">
                                    <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                    </svg>
                                </button>
                                
                                <div x-show="open" 
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 bottom-full mb-2 w-48 bg-white rounded-lg shadow-lg border border-neutral-200 py-1 z-50">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-50">
                                        Profil
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                            Se déconnecter
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile sidebar -->
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="md:hidden relative flex-1 flex flex-col max-w-xs w-full bg-white">
                <!-- Mobile sidebar content (same as desktop) -->
                <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-6">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h1 class="ml-3 text-xl font-bold text-neutral-900">TaskFlow</h1>
                        </div>
                    </div>
                    <nav class="mt-8 flex-1 px-4 space-y-1">
                        <!-- Same navigation as desktop -->
                    </nav>
                </div>
            </div>

            <!-- Main content -->
            <div class="md:pl-64 flex flex-col flex-1">
                <!-- Top bar -->
                <div class="sticky top-0 z-10 md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 bg-neutral-50">
                    <button @click="sidebarOpen = true" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-neutral-500 hover:text-neutral-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <span class="sr-only">Ouvrir la sidebar</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <!-- Page header -->
                @isset($header)
                    <header class="page-header">
                        {{ $header }}
                    </header>
                @endisset

                <!-- Page content -->
                <main class="flex-1">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <!-- Notifications -->
        <div id="notifications" class="fixed top-4 right-4 z-50 space-y-2"></div>

        <!-- Scripts -->
        <script>
            // Fonction pour afficher les notifications
            function showNotification(message, type = 'success') {
                const notification = document.createElement('div');
                notification.className = `notification ${type} animate-slide-in-up`;
                notification.innerHTML = `
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            ${type === 'success' ? 
                                '<svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' :
                                type === 'error' ?
                                '<svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>' :
                                '<svg class="h-5 w-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>'
                            }
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-neutral-900">${message}</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <button onclick="this.parentElement.parentElement.parentElement.remove()" class="inline-flex text-neutral-400 hover:text-neutral-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
                
                document.getElementById('notifications').appendChild(notification);
                
                // Auto-remove after 5 seconds
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 5000);
            }

            // Afficher les messages flash Laravel
            @if(session('success'))
                showNotification('{{ session('success') }}', 'success');
            @endif
            
            @if(session('error'))
                showNotification('{{ session('error') }}', 'error');
            @endif
            
            @if(session('warning'))
                showNotification('{{ session('warning') }}', 'warning');
            @endif
        </script>
    </body>
</html>