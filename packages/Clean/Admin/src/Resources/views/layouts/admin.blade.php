<!DOCTYPE html>
<html lang="es" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Clean Admin')</title>
    
    <!-- TailwindCSS Admin -->
    @vite(['packages/Clean/Admin/resources/assets/css/admin.css'])
    
    <!-- Alpine.js para interactividad -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Heroicons para iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/heroicons@2.0.18/24/outline/heroicons.css">
</head>
<body class="h-full bg-gray-50" x-data="{ sidebarOpen: false }">
    
    <!-- Sidebar móvil overlay -->
    <div x-show="sidebarOpen" class="relative z-50 lg:hidden" x-transition>
        <div class="fixed inset-0 bg-gray-900/80" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
        
        <div class="fixed inset-0 flex">
            <div x-show="sidebarOpen" class="relative mr-16 flex w-full max-w-xs flex-1" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                    <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                        <span class="sr-only">Cerrar sidebar</span>
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Sidebar móvil -->
                @include('clean-admin::partials.sidebar')
            </div>
        </div>
    </div>

    <!-- Sidebar desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
        @include('clean-admin::partials.sidebar')
    </div>

    <div class="lg:pl-72">
        <!-- Header sticky -->
        <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
            <!-- Botón menú móvil -->
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
                <span class="sr-only">Abrir sidebar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <!-- Separador -->
            <div class="h-6 w-px bg-gray-200 lg:hidden"></div>

            <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                <!-- Breadcrumbs -->
                <div class="flex items-center">
                    @yield('breadcrumbs')
                </div>

                <!-- Spacer -->
                <div class="flex-1"></div>

                <!-- Acciones del header -->
                <div class="flex items-center gap-x-4 lg:gap-x-6">
                    <!-- Notificaciones -->
                    <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Ver notificaciones</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </button>

                    <!-- Separador -->
                    <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200"></div>

                    <!-- Perfil de usuario -->
                    <div class="relative" x-data="{ profileOpen: false }">
                        <button type="button" class="-m-1.5 flex items-center p-1.5" @click="profileOpen = !profileOpen">
                            <span class="sr-only">Abrir menú de usuario</span>
                            <div class="h-8 w-8 rounded-full bg-emerald-500 flex items-center justify-center">
                                <span class="text-sm font-medium text-white">A</span>
                            </div>
                            <span class="hidden lg:flex lg:items-center">
                                <span class="ml-4 text-sm font-semibold leading-6 text-gray-900">Admin</span>
                                <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="profileOpen" @click.away="profileOpen = false" x-transition class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5">
                            <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50">Tu perfil</a>
                            <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50">Configuración</a>
                            <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50">Cerrar sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <main class="py-10">
            <div class="px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>