@extends('clean-admin::layouts.admin')

@section('title', 'Dashboard - Clean Admin')

@section('breadcrumbs')
    <nav class="flex" aria-label="Breadcrumb">
        <ol role="list" class="flex items-center space-x-4">
            <li>
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Inicio</span>
                    </a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-4 text-sm font-medium text-gray-500">Dashboard</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <!-- Alertas de seguridad -->
    @if(!empty($safetyAlerts))
        <div class="mb-8">
            @foreach($safetyAlerts as $alert)
                <div class="rounded-md bg-yellow-50 p-4 mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">{{ $alert['message'] }}</h3>
                            <div class="mt-2">
                                <button class="text-sm text-yellow-700 hover:text-yellow-600">{{ $alert['action'] }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Estadísticas principales -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <!-- Total Productos -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-emerald-500">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.75 7.5h16.5-1.5a.75.75 0 00-.75-.75H5.25a.75.75 0 00-.75.75v0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Productos</dt>
                            <dd class="text-2xl font-bold text-gray-900">{{ number_format($statistics['total_products']) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos Ecológicos -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-green-500">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Productos Ecológicos</dt>
                            <dd class="flex items-baseline">
                                <span class="text-2xl font-bold text-gray-900">{{ number_format($statistics['eco_friendly_products']) }}</span>
                                <span class="ml-2 text-sm font-medium text-green-600">{{ $statistics['eco_percentage'] }}%</span>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos Seguros -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-500">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Productos Seguros</dt>
                            <dd class="flex items-baseline">
                                <span class="text-2xl font-bold text-gray-900">{{ number_format($statistics['safe_products']) }}</span>
                                <span class="ml-2 text-sm font-medium text-blue-600">{{ $statistics['safety_percentage'] }}%</span>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos Peligrosos -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-red-500">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Productos Peligrosos</dt>
                            <dd class="flex items-baseline">
                                <span class="text-2xl font-bold text-gray-900">{{ number_format($statistics['hazardous_products']) }}</span>
                                @if($statistics['total_products'] > 0)
                                    <span class="ml-2 text-sm font-medium text-red-600">
                                        {{ round(($statistics['hazardous_products'] / $statistics['total_products']) * 100, 1) }}%
                                    </span>
                                @endif
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grid de contenido -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Productos Recientes -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Productos Recientes</h3>
                        <a href="{{ route('admin.clean.products') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-500">
                            Ver todos
                        </a>
                    </div>
                </div>
                <div class="px-6 py-4">
                    @forelse($recentProducts as $product)
                        <div class="flex items-center justify-between py-3 @if(!$loop->last) border-b border-gray-200 @endif">
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-900 truncate">
                                    {{ $product->product->name ?? 'Producto #' . $product->id }}
                                </h4>
                                <p class="text-sm text-gray-500">
                                    {{ $product->brand->name ?? 'Sin marca' }} · {{ $product->category->name ?? 'Sin categoría' }}
                                </p>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if($product->is_eco_friendly)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Eco
                                    </span>
                                @endif
                                @switch($product->safety_classification)
                                    @case('non_hazardous')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Seguro
                                        </span>
                                        @break
                                    @case('hazardous')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Peligroso
                                        </span>
                                        @break
                                    @default
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            {{ ucfirst($product->safety_classification) }}
                                        </span>
                                @endswitch
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6">
                            <p class="text-sm text-gray-500">No hay productos recientes</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Marcas y Acciones Rápidas -->
        <div class="space-y-6">
            <!-- Marcas Populares -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Marcas Populares</h3>
                        <a href="{{ route('admin.clean.brands') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-500">
                            Ver todas
                        </a>
                    </div>
                </div>
                <div class="px-6 py-4">
                    @forelse($topBrands as $brand)
                        <div class="flex items-center justify-between py-2 @if(!$loop->last) border-b border-gray-200 @endif">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-medium text-gray-900">{{ $brand->name }}</span>
                                @if($brand->is_eco_friendly)
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Eco
                                    </span>
                                @endif
                            </div>
                            <span class="text-xs text-gray-500">{{ $brand->products_count }} productos</span>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <p class="text-sm text-gray-500">No hay marcas disponibles</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Acciones Rápidas</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('admin.clean.safety') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-lg bg-red-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <span class="text-sm font-medium text-gray-900">Reportes de Seguridad</span>
                        </div>
                    </a>

                    <a href="{{ route('admin.clean.analytics') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <span class="text-sm font-medium text-gray-900">Ver Análisis</span>
                        </div>
                    </a>

                    <a href="{{ route('admin.clean.settings') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-lg bg-gray-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <span class="text-sm font-medium text-gray-900">Configuración</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection