@extends('clean-admin::layouts.admin')

@section('title', 'Gestión de Marcas Clean')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Compacto -->
    <div class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Gestión de Marcas</h1>
                    <p class="text-sm text-gray-500">{{ $totalBrands ?? $brands->count() }} marcas • {{ $countriesCount ?? $countries->count() }} países</p>
                </div>
            </div>
            <div class="text-right">
                <span class="text-xs text-gray-500">Administración de Marcas Clean</span>
            </div>
        </div>
    </div>

    <!-- Panel de Control Integrado -->
    <div class="px-4 py-4">
        <!-- Estadísticas Compactas -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-4">
            <div class="bg-white rounded-lg p-4 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalBrands ?? $brands->count() }}</p>
                        <p class="text-xs text-gray-500">Total Marcas</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $activeBrands ?? $brands->where('status', true)->count() }}</p>
                        <p class="text-xs text-gray-500">Activas</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $ecoFriendlyBrands ?? $brands->where('is_eco_friendly', true)->count() }}</p>
                        <p class="text-xs text-gray-500">Ecológicas</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $countriesCount ?? $countries->count() }}</p>
                        <p class="text-xs text-gray-500">Países</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel de Acciones y Filtros -->
        <div class="bg-white rounded-lg border border-gray-200 mb-4">
            <!-- Acciones Principales -->
            <div class="p-3 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Acciones:</span>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-2">
                        <!-- CREAR MARCA - Botón Principal -->
                        <a href="{{ route('admin.clean.brands.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span class="hidden sm:inline">Nueva Marca</span>
                            <span class="sm:hidden">Nueva</span>
                        </a>

                        <!-- EXPORTAR -->
                        <button onclick="showExportModal()" class="bg-purple-500 hover:bg-purple-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="hidden sm:inline">Exportar</span>
                        </button>

                        <!-- CARGA MASIVA -->
                        <button onclick="showBulkModal()" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <span class="hidden sm:inline">Carga Masiva</span>
                            <span class="sm:hidden">Masiva</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filtros y Búsqueda -->
            <div class="p-3">
                <form id="filters-form" method="GET" action="{{ route('admin.clean.brands.index') }}" class="space-y-3">
                    <!-- Búsqueda Principal -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="search" id="search" value="{{ $filters['search'] ?? '' }}" 
                                       placeholder="Buscar marcas..." 
                                       class="auto-filter block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500"
                                       data-delay="500">
                            </div>
                        </div>
                    </div>

                    <!-- Filtros Adicionales - Solo visible en modo expandido -->
                    <div id="advanced-filters" class="hidden">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                            <!-- País -->
                            <div>
                                <select name="country" class="auto-filter w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="">Todos los países</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}" {{ ($filters['country'] ?? '') === $country ? 'selected' : '' }}>{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Ecológica -->
                            <div>
                                <select name="eco_friendly" class="auto-filter w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="">Todas las marcas</option>
                                    <option value="1" {{ ($filters['eco_friendly'] ?? '') === '1' ? 'selected' : '' }}>Solo ecológicas</option>
                                    <option value="0" {{ ($filters['eco_friendly'] ?? '') === '0' ? 'selected' : '' }}>Solo no ecológicas</option>
                                </select>
                            </div>

                            <!-- Estado -->
                            <div>
                                <select name="status" class="auto-filter w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="">Todos los estados</option>
                                    <option value="1" {{ ($filters['status'] ?? '') === '1' ? 'selected' : '' }}>Activas</option>
                                    <option value="0" {{ ($filters['status'] ?? '') === '0' ? 'selected' : '' }}>Inactivas</option>
                                </select>
                            </div>

                            <!-- Ordenamiento -->
                            <div>
                                <select name="sort_by" class="auto-filter w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="sort_order" {{ ($filters['sort_by'] ?? 'sort_order') === 'sort_order' ? 'selected' : '' }}>Orden predeterminado</option>
                                    <option value="name" {{ ($filters['sort_by'] ?? '') === 'name' ? 'selected' : '' }}>Nombre</option>
                                    <option value="country" {{ ($filters['sort_by'] ?? '') === 'country' ? 'selected' : '' }}>País</option>
                                    <option value="created_at" {{ ($filters['sort_by'] ?? '') === 'created_at' ? 'selected' : '' }}>Fecha de creación</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Toggle Filtros Avanzados -->
                    <div class="flex items-center justify-between">
                        <button type="button" onclick="toggleAdvancedFilters()" class="text-sm text-blue-600 hover:text-blue-700 flex items-center">
                            <svg id="filter-icon" class="w-4 h-4 mr-1 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                            <span id="filter-text">Filtros avanzados</span>
                        </button>

                        @if(array_filter($filters ?? []))
                            <a href="{{ route('admin.clean.brands.index') }}" class="text-sm text-gray-500 hover:text-gray-700">
                                Limpiar filtros
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de Marcas -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            @if($brands->count() > 0)
                <!-- Controles de Selección -->
                <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="selectAll" class="text-sm text-gray-700">Seleccionar todo</label>
                            <span id="selectedCount" class="text-sm text-gray-500 hidden">0 seleccionados</span>
                        </div>
                        
                        <!-- Acciones en lote -->
                        <div id="bulkActions" class="hidden flex items-center space-x-2">
                            <select id="bulkActionSelect" class="text-sm border border-gray-300 rounded px-2 py-1">
                                <option value="">Acción en lote...</option>
                                <option value="activate">Activar</option>
                                <option value="deactivate">Desactivar</option>
                                <option value="toggle_eco">Alternar ecológica</option>
                                <option value="export">Exportar seleccionados</option>
                                <option value="delete">Eliminar</option>
                            </select>
                            <button onclick="executeBulkAction()" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                Ejecutar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tabla Responsiva -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="w-4 px-4 py-3">
                                    <span class="sr-only">Seleccionar</span>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marca</th>
                                <th class="hidden md:table-cell px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">País</th>
                                <th class="hidden lg:table-cell px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Productos</th>
                                <th class="hidden sm:table-cell px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($brands as $brand)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <!-- Checkbox de Selección -->
                                    <td class="px-4 py-4">
                                        <input type="checkbox" class="brand-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                                               value="{{ $brand->id }}">
                                    </td>

                                    <!-- Información de la Marca -->
                                    <td class="px-4 py-4">
                                        <div class="flex items-center">
                                            @if($brand->logo)
                                                <img class="h-10 w-10 rounded-lg object-cover mr-3" src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}">
                                            @else
                                                <div class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center mr-3">
                                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="flex items-center">
                                                    <span class="text-sm font-medium text-gray-900">{{ $brand->name }}</span>
                                                    @if($brand->is_eco_friendly)
                                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                            </svg>
                                                            Eco
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ Str::limit($brand->description, 50) }}
                                                    @if($brand->website)
                                                        <a href="{{ $brand->website }}" target="_blank" class="text-blue-500 hover:text-blue-700 ml-1">
                                                            <svg class="w-3 h-3 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                            </svg>
                                                        </a>
                                                    @endif
                                                </div>
                                                <!-- Info adicional en móviles -->
                                                <div class="mt-1 text-xs text-gray-500 md:hidden">
                                                    @if($brand->country)
                                                        <span class="inline-flex items-center">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            </svg>
                                                            {{ $brand->country }}
                                                        </span>
                                                    @endif
                                                    <span class="ml-2 lg:hidden">{{ $brand->products_count ?? 0 }} productos</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- País -->
                                    <td class="hidden md:table-cell px-4 py-4 text-sm text-gray-500">
                                        @if($brand->country)
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                {{ $brand->country }}
                                            </div>
                                        @else
                                            <span class="text-gray-400">No especificado</span>
                                        @endif
                                    </td>

                                    <!-- Productos -->
                                    <td class="hidden lg:table-cell px-4 py-4 text-sm text-gray-900 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $brand->products_count ?? 0 }}
                                        </span>
                                    </td>

                                    <!-- Estado -->
                                    <td class="hidden sm:table-cell px-4 py-4 text-center">
                                        @if($brand->status)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Activa
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Inactiva
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Acciones -->
                                    <td class="px-4 py-4 text-center">
                                        <div class="flex items-center justify-center space-x-1">
                                            <!-- Ver -->
                                            <a href="{{ route('admin.clean.brands.show', $brand) }}" 
                                               class="inline-flex items-center justify-center w-8 h-8 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors duration-200" 
                                               title="Ver marca">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>

                                            <!-- Editar -->
                                            <a href="{{ route('admin.clean.brands.edit', $brand) }}" 
                                               class="inline-flex items-center justify-center w-8 h-8 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors duration-200" 
                                               title="Editar marca">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>

                                            <!-- Eliminar -->
                                            <button onclick="confirmDelete('{{ $brand->id }}', '{{ $brand->name }}')" 
                                                    class="inline-flex items-center justify-center w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-200" 
                                                    title="Eliminar marca">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if($brands->hasPages())
                    <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                        {{ $brands->links() }}
                    </div>
                @endif
            @else
                <!-- Estado Vacío -->
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No hay marcas</h3>
                    <p class="mt-1 text-sm text-gray-500">Comienza creando tu primera marca.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.clean.brands.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-emerald-500 hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Nueva Marca
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Formulario para eliminar (oculto) -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('scripts')
<script>
// Configuración para filtros automáticos
let filterTimeout;
const AUTO_FILTER_DELAY = 500; // 500ms de debounce para búsqueda

// Toggle filtros avanzados
function toggleAdvancedFilters() {
    const filters = document.getElementById('advanced-filters');
    const icon = document.getElementById('filter-icon');
    const text = document.getElementById('filter-text');
    
    if (filters.classList.contains('hidden')) {
        filters.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
        text.textContent = 'Ocultar filtros';
    } else {
        filters.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
        text.textContent = 'Filtros avanzados';
    }
}

function initAutoFilters() {
    const form = document.getElementById('filters-form');
    const autoFilterElements = document.querySelectorAll('.auto-filter');
    
    autoFilterElements.forEach(element => {
        if (element.type === 'text' || element.type === 'search') {
            // Para campos de texto, usar debounce
            element.addEventListener('input', function() {
                clearTimeout(filterTimeout);
                const delay = parseInt(element.getAttribute('data-delay')) || AUTO_FILTER_DELAY;
                
                filterTimeout = setTimeout(() => {
                    submitFilters();
                }, delay);
            });
        } else {
            // Para selects, aplicar filtro inmediatamente
            element.addEventListener('change', function() {
                clearTimeout(filterTimeout);
                submitFilters();
            });
        }
    });
}

function submitFilters() {
    const form = document.getElementById('filters-form');
    if (form) {
        // Guardar información del elemento activo
        const activeElement = document.activeElement;
        if (activeElement && (activeElement.type === 'text' || activeElement.type === 'search')) {
            const elementId = activeElement.id || activeElement.name;
            const cursorPosition = activeElement.selectionStart;
            
            // Guardar en sessionStorage para restaurar después de la recarga
            sessionStorage.setItem('focusedElement', elementId);
            sessionStorage.setItem('cursorPosition', cursorPosition);
        }
        
        // Mostrar indicador de carga
        showLoadingIndicator();
        form.submit();
    }
}

// Restaurar foco después de la recarga de página
function restoreFocus() {
    const focusedElementId = sessionStorage.getItem('focusedElement');
    const cursorPosition = sessionStorage.getItem('cursorPosition');
    
    if (focusedElementId) {
        const element = document.getElementById(focusedElementId) || document.querySelector(`[name="${focusedElementId}"]`);
        if (element) {
            // Pequeño delay para asegurar que el DOM esté completamente cargado
            setTimeout(() => {
                element.focus();
                if (cursorPosition && (element.type === 'text' || element.type === 'search')) {
                    element.setSelectionRange(cursorPosition, cursorPosition);
                }
            }, 100);
        }
        
        // Limpiar sessionStorage
        sessionStorage.removeItem('focusedElement');
        sessionStorage.removeItem('cursorPosition');
    }
}

function showLoadingIndicator() {
    // Ya no necesitamos mostrar indicador de carga ya que los filtros son automáticos
    // Esta función se mantiene para compatibilidad pero no hace nada
}

// Gestión de selección múltiple
document.addEventListener('DOMContentLoaded', function() {
    initAutoFilters();
    restoreFocus();
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.brand-checkbox');
    const selectedCount = document.getElementById('selectedCount');
    const bulkActions = document.getElementById('bulkActions');

    selectAll?.addEventListener('change', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkActions();
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });

    function updateBulkActions() {
        const selected = document.querySelectorAll('.brand-checkbox:checked');
        const count = selected.length;
        
        if (count > 0) {
            selectedCount.textContent = `${count} seleccionados`;
            selectedCount.classList.remove('hidden');
            bulkActions.classList.remove('hidden');
        } else {
            selectedCount.classList.add('hidden');
            bulkActions.classList.add('hidden');
        }
        
        selectAll.indeterminate = count > 0 && count < checkboxes.length;
        selectAll.checked = count === checkboxes.length;
    }
});

// Ejecutar acción en lote
function executeBulkAction() {
    const action = document.getElementById('bulkActionSelect').value;
    const selected = Array.from(document.querySelectorAll('.brand-checkbox:checked')).map(cb => cb.value);
    
    if (!action || selected.length === 0) {
        alert('Selecciona una acción y al menos una marca');
        return;
    }
    
    if (action === 'delete' && !confirm('¿Estás seguro de que quieres eliminar las marcas seleccionadas?')) {
        return;
    }
    
    // Enviar petición AJAX
    fetch('{{ route("admin.clean.brands.bulk-action") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            action: action,
            brand_ids: selected
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al ejecutar la acción');
    });
}

// Confirmar eliminación individual
function confirmDelete(brandId, brandName) {
    if (confirm(`¿Estás seguro de que quieres eliminar la marca "${brandName}"?`)) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/clean/brands/${brandId}`;
        form.submit();
    }
}

// Mostrar modal de exportación
function showExportModal() {
    // Implementar modal de exportación
    window.open('{{ route("admin.clean.brands.export") }}?format=csv', '_blank');
}

// Mostrar modal de carga masiva
function showBulkModal() {
    // Implementar modal de carga masiva
    alert('Funcionalidad de carga masiva en desarrollo');
}
</script>
@endpush