<!-- Sidebar -->
<div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4 shadow-xl ring-1 ring-white/10">
    <!-- Logo -->
    <div class="flex h-16 shrink-0 items-center">
        <div class="flex items-center space-x-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-500">
                <span class="text-lg font-bold text-white">🧽</span>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-900">Clean</h1>
                <p class="text-xs text-gray-500">Admin Panel</p>
            </div>
        </div>
    </div>

    <!-- Navegación -->
    <nav class="flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="{{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.clean.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:text-emerald-700 hover:bg-emerald-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.clean.dashboard') ? 'text-emerald-500' : 'text-gray-400 group-hover:text-emerald-500' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Dashboard
                        </a>
                    </li>

                    <!-- Productos -->
                    <li>
                        <a href="{{ route('admin.clean.products.index') }}" 
                           class="{{ request()->routeIs('admin.clean.products*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:text-emerald-700 hover:bg-emerald-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ request()->routeIs('admin.clean.products*') ? 'text-emerald-500' : 'text-gray-400 group-hover:text-emerald-500' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.75 7.5h16.5-1.5a.75.75 0 00-.75-.75H5.25a.75.75 0 00-.75.75v0z" />
                            </svg>
                            Productos
                            <span class="ml-auto rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-600">{{ $statistics['total_products'] ?? 0 }}</span>
                        </a>
                    </li>

                    <!-- Marcas -->
                    <li>
                        <a href="{{ route('admin.clean.brands.index') }}" 
                           class="{{ request()->routeIs('admin.clean.brands*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:text-emerald-700 hover:bg-emerald-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ request()->routeIs('admin.clean.brands*') ? 'text-emerald-500' : 'text-gray-400 group-hover:text-emerald-500' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>
                            Marcas
                            <span class="ml-auto rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-600">{{ $statistics['total_brands'] ?? 0 }}</span>
                        </a>
                    </li>

                    <!-- Categorías -->
                    <li>
                        <a href="{{ route('admin.clean.categories.index') }}" 
                           class="{{ request()->routeIs('admin.clean.categories*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:text-emerald-700 hover:bg-emerald-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ request()->routeIs('admin.clean.categories*') ? 'text-emerald-500' : 'text-gray-400 group-hover:text-emerald-500' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25A1.125 1.125 0 013.75 18.375v-2.25z" />
                            </svg>
                            Categorías
                            <span class="ml-auto rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-600">{{ $statistics['total_categories'] ?? 0 }}</span>
                        </a>
                    </li>

                    <!-- Ingredientes -->
                    <li>
                        <a href="{{ route('admin.clean.ingredients') }}" 
                           class="{{ request()->routeIs('admin.clean.ingredients*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:text-emerald-700 hover:bg-emerald-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ request()->routeIs('admin.clean.ingredients*') ? 'text-emerald-500' : 'text-gray-400 group-hover:text-emerald-500' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.611L5 14.5" />
                            </svg>
                            Ingredientes
                            <span class="ml-auto rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-600">{{ $statistics['total_ingredients'] ?? 0 }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Sección de Análisis -->
            <li>
                <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wide">Análisis</div>
                <ul role="list" class="-mx-2 mt-2 space-y-1">
                    <!-- Seguridad -->
                    <li>
                        <a href="{{ route('admin.clean.safety') }}" 
                           class="{{ request()->routeIs('admin.clean.safety*') ? 'bg-red-50 text-red-700' : 'text-gray-700 hover:text-red-700 hover:bg-red-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ request()->routeIs('admin.clean.safety*') ? 'text-red-500' : 'text-gray-400 group-hover:text-red-500' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                            Seguridad
                            @if(($statistics['hazardous_products'] ?? 0) > 0)
                                <span class="ml-auto rounded-full bg-red-100 px-2 py-0.5 text-xs text-red-700">{{ $statistics['hazardous_products'] }}</span>
                            @endif
                        </a>
                    </li>

                    <!-- Analytics -->
                    <li>
                        <a href="{{ route('admin.clean.analytics') }}" 
                           class="{{ request()->routeIs('admin.clean.analytics*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:text-emerald-700 hover:bg-emerald-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ request()->routeIs('admin.clean.analytics*') ? 'text-emerald-500' : 'text-gray-400 group-hover:text-emerald-500' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>
                            Analytics
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Sección de Configuración -->
            <li class="mt-auto">
                <ul role="list" class="-mx-2 space-y-1">
                    <!-- Configuración -->
                    <li>
                        <a href="{{ route('admin.clean.settings') }}" 
                           class="{{ request()->routeIs('admin.clean.settings*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:text-emerald-700 hover:bg-emerald-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ request()->routeIs('admin.clean.settings*') ? 'text-emerald-500' : 'text-gray-400 group-hover:text-emerald-500' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Configuración
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>