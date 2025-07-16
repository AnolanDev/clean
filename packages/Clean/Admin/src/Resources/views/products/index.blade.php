@extends('clean-admin::layouts.admin')

@section('title', 'Catálogo de Productos Clean')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Compacto -->
    <div class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Catálogo de Productos</h1>
                    <p class="text-sm text-gray-500">{{ $totalProducts ?? $products->count() }} productos • {{ $brandsCount ?? $brands->count() }} marcas</p>
                </div>
            </div>
            <div class="text-right">
                <span class="text-xs text-gray-500">Gestión del Catálogo Clean</span>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalProducts ?? $products->count() }}</p>
                        <p class="text-xs text-gray-500">Total Productos</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $ecoFriendlyCount ?? $products->where('is_eco_friendly', true)->count() }}</p>
                        <p class="text-xs text-gray-500">Ecológicos</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $antibacterialCount ?? $products->where('is_antibacterial', true)->count() }}</p>
                        <p class="text-xs text-gray-500">Antibacteriales</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $brandsCount ?? $brands->count() }}</p>
                        <p class="text-xs text-gray-500">Marcas</p>
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
                        <!-- CREAR PRODUCTO - Botón Principal -->
                        <a href="{{ route('admin.clean.products.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="hidden sm:inline">Nuevo Producto</span>
                            <span class="sm:hidden">Nuevo</span>
                        </a>
                        
                        <!-- Importar Excel -->
                        <button onclick="importCatalog()" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                            </svg>
                            <span class="hidden sm:inline">Importar</span>
                        </button>
                        
                        <!-- Exportar -->
                        <button onclick="exportProducts()" class="bg-purple-500 hover:bg-purple-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="hidden sm:inline">Exportar</span>
                        </button>
                        
                        <!-- Más opciones en móvil -->
                        <div class="relative sm:hidden">
                            <button class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Carga Masiva - Solo desktop -->
                        <button onclick="bulkUpload()" class="hidden sm:flex bg-orange-500 hover:bg-orange-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Carga Masiva
                        </button>
                        
                        <!-- Menú de Opciones -->
                        <div class="relative">
                            <button onclick="toggleOptionsMenu()" class="group relative bg-gradient-to-r from-slate-500 to-slate-600 hover:from-slate-600 hover:to-slate-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                                Más
                            </button>
                            <div id="optionsMenu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl z-10 border border-gray-100 overflow-hidden">
                                <div class="py-2">
                                    <button onclick="printCatalog()" class="flex items-center w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 transition-all duration-200">
                                        <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">🖨️</span>
                                        <span class="font-medium">Imprimir Catálogo</span>
                                    </button>
                                    <button onclick="duplicateSelected()" class="flex items-center w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 hover:text-green-700 transition-all duration-200">
                                        <span class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">📋</span>
                                        <span class="font-medium">Duplicar Seleccionados</span>
                                    </button>
                                    <button onclick="bulkEdit()" class="flex items-center w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 hover:text-purple-700 transition-all duration-200">
                                        <span class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">✏️</span>
                                        <span class="font-medium">Edición Masiva</span>
                                    </button>
                                    <hr class="my-2 border-gray-100">
                                    <button onclick="manageCategories()" class="flex items-center w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-yellow-50 hover:to-orange-50 hover:text-yellow-700 transition-all duration-200">
                                        <span class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">📁</span>
                                        <span class="font-medium">Gestionar Categorías</span>
                                    </button>
                                    <button onclick="manageBrands()" class="flex items-center w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 hover:text-red-700 transition-all duration-200">
                                        <span class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">🏷️</span>
                                        <span class="font-medium">Gestionar Marcas</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filtros -->
            <div class="p-4">
                <div class="flex flex-wrap items-center gap-3">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Filtros:</span>
                    </div>
                    
                    <select id="brandFilter" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Todas las marcas</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    
                    <select id="categoryFilter" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Todas las categorías</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    
                    <select id="characteristicFilter" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Características</option>
                        <option value="eco_friendly">🌿 Ecológico</option>
                        <option value="antibacterial">🦠 Antibacterial</option>
                        <option value="antiviral">🛡️ Antiviral</option>
                        <option value="biodegradable">♻️ Biodegradable</option>
                        <option value="food_safe">🍎 Seguro alimentos</option>
                        <option value="no_residue">✨ Sin residuos</option>
                    </select>
                    
                    <div class="flex-1 min-w-[200px]">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="searchFilter" placeholder="Buscar productos..." class="block w-full pl-10 pr-3 py-1 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de productos optimizada -->
    <div class="px-4">
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm" id="productsTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-2 py-3 text-left">
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider min-w-0">Producto</th>
                            <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Marca/Categoría</th>
                            <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Presentaciones</th>
                            <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Características</th>
                            <th class="px-2 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-2 py-2">
                                    <input type="checkbox" name="selected_products[]" value="{{ $product->id }}" class="product-checkbox rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </td>
                                <td class="px-3 py-2">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 bg-blue-500 rounded-md flex items-center justify-center text-white font-semibold text-xs mr-2 flex-shrink-0">
                                            {{ strtoupper(substr($product->name ?? 'P', 0, 1)) }}
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <div class="text-sm font-medium text-gray-900 truncate">
                                                {{ $product->name ?? 'Producto #' . $product->id }}
                                            </div>
                                            <div class="text-xs text-gray-500 truncate sm:hidden">
                                                {{ $product->brand->name ?? 'N/A' }} • {{ $product->category->name ?? 'N/A' }}
                                            </div>
                                            <div class="text-xs text-gray-500 truncate hidden sm:block">
                                                {{ Str::limit($product->description ?? 'Sin descripción', 30) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 py-2 hidden sm:table-cell">
                                    <div class="space-y-1">
                                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            {{ $product->brand->name ?? 'N/A' }}
                                        </span>
                                        <br>
                                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-700">
                                            {{ $product->category->name ?? 'N/A' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-2 py-2 hidden md:table-cell">
                                    <div class="flex flex-wrap gap-1">
                                        @if($product->presentations && is_array($product->presentations) && count($product->presentations) > 0)
                                            @foreach(array_slice($product->presentations, 0, 1) as $presentation)
                                                <span class="inline-flex px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                                    {{ $presentation }}
                                                </span>
                                            @endforeach
                                            @if(count($product->presentations) > 1)
                                                <span class="inline-flex px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">
                                                    +{{ count($product->presentations) - 1 }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-xs text-gray-400">Sin presentaciones</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-2 py-2 hidden lg:table-cell">
                                    <div class="flex flex-wrap gap-1">
                                        @if($product->is_eco_friendly)
                                            <span class="inline-flex items-center text-xs text-green-700" title="Ecológico">🌿</span>
                                        @endif
                                        @if($product->is_antibacterial)
                                            <span class="inline-flex items-center text-xs text-red-700" title="Antibacterial">🦠</span>
                                        @endif
                                        @if($product->is_antiviral)
                                            <span class="inline-flex items-center text-xs text-red-700" title="Antiviral">🛡️</span>
                                        @endif
                                        @if($product->food_contact_safe)
                                            <span class="inline-flex items-center text-xs text-blue-700" title="Seguro para alimentos">🍎</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-2 py-2">
                                    <div class="flex items-center justify-center space-x-1">
                                        <a href="{{ route('admin.clean.products.show', $product) }}" class="inline-flex items-center justify-center w-8 h-8 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors duration-200" title="Ver producto">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.clean.products.edit', $product) }}" class="inline-flex items-center justify-center w-8 h-8 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md transition-colors duration-200" title="Editar producto">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <button onclick="deleteProduct({{ $product->id }})" class="inline-flex items-center justify-center w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-md transition-colors duration-200" title="Eliminar producto">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-6.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H0"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay productos</h3>
                                        <p class="text-gray-500 mb-4">Agrega productos manualmente o importa desde Excel.</p>
                                        <div class="flex space-x-3">
                                            <button onclick="importCatalog()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-200">
                                                Importar Catálogo
                                            </button>
                                            <a href="{{ route('admin.clean.products.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-200">
                                                Nuevo Producto
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(isset($products) && method_exists($products, 'hasPages') && $products->hasPages())
                <div class="px-6 py-3 border-t border-gray-200 bg-gray-50">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Footer con información -->
    <div class="px-6 py-4">
        <div class="text-center text-sm text-gray-500">
            Mostrando {{ $products->count() }} de {{ $totalProducts ?? $products->total() ?? $products->count() }} productos
        </div>
    </div>
</div>

<!-- Modal de importación -->
<div id="importModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Importar Catálogo</h3>
                <button onclick="closeImportModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Archivo CSV</label>
                    <input type="file" id="catalogFile" accept=".csv" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Convertir Excel a CSV antes de importar</p>
                </div>
                <div class="flex space-x-3">
                    <button onclick="executeImport()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Importar
                    </button>
                    <button onclick="closeImportModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg transition duration-200">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function importCatalog() {
    document.getElementById('importModal').classList.remove('hidden');
}

function closeImportModal() {
    document.getElementById('importModal').classList.add('hidden');
}

function executeImport() {
    const fileInput = document.getElementById('catalogFile');
    if (!fileInput.files.length) {
        alert('Por favor selecciona un archivo CSV');
        return;
    }
    
    alert('Funcionalidad de importación en desarrollo. Use: php artisan clean:import-catalog archivo.csv --format=csv');
    closeImportModal();
}

// Nuevas funciones para las acciones
function exportProducts() {
    alert('Funcionalidad de exportación en desarrollo. Se exportarán todos los productos filtrados.');
}

function bulkUpload() {
    alert('Funcionalidad de carga masiva en desarrollo. Permitirá subir múltiples productos desde Excel/CSV.');
}

function toggleOptionsMenu() {
    const menu = document.getElementById('optionsMenu');
    menu.classList.toggle('hidden');
}

function printCatalog() {
    window.print();
    toggleOptionsMenu();
}

function duplicateSelected() {
    const selected = getSelectedProducts();
    if (selected.length === 0) {
        alert('Por favor selecciona al menos un producto para duplicar.');
        return;
    }
    
    if (confirm(`¿Deseas duplicar ${selected.length} producto(s) seleccionado(s)?`)) {
        alert(`Funcionalidad de duplicación masiva en desarrollo. Se duplicarían ${selected.length} productos.`);
    }
    toggleOptionsMenu();
}

function bulkEdit() {
    const selected = getSelectedProducts();
    if (selected.length === 0) {
        alert('Por favor selecciona al menos un producto para editar.');
        return;
    }
    
    alert(`Funcionalidad de edición masiva en desarrollo. Se editarían ${selected.length} productos.`);
    toggleOptionsMenu();
}

function manageCategories() {
    // Redirigir a gestión de categorías
    window.location.href = '{{ route("admin.clean.categories.index") }}';
}

function manageBrands() {
    // Redirigir a gestión de marcas
    window.location.href = '{{ route("admin.clean.brands.index") }}';
}

// Cerrar menú al hacer clic fuera
document.addEventListener('click', function(event) {
    const menu = document.getElementById('optionsMenu');
    const button = event.target.closest('button[onclick="toggleOptionsMenu()"]');
    
    if (!button && !menu.contains(event.target)) {
        menu.classList.add('hidden');
    }
});

function deleteProduct(id) {
    if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
        // Crear formulario para DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/clean/products/${id}`;
        
        // Agregar token CSRF
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // Agregar method DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}

// Filtros en tiempo real mejorados
document.addEventListener('DOMContentLoaded', function() {
    const brandFilter = document.getElementById('brandFilter');
    const categoryFilter = document.getElementById('categoryFilter');
    const characteristicFilter = document.getElementById('characteristicFilter');
    const searchFilter = document.getElementById('searchFilter');
    const productsTable = document.getElementById('productsTable');
    const tableRows = productsTable.querySelectorAll('tbody tr');
    
    function applyFilters() {
        const filters = {
            brand: brandFilter.value.toLowerCase(),
            category: categoryFilter.value.toLowerCase(),
            characteristic: characteristicFilter.value.toLowerCase(),
            search: searchFilter.value.toLowerCase()
        };
        
        let visibleCount = 0;
        
        tableRows.forEach(row => {
            if (row.querySelector('td[colspan]')) return; // Skip empty state row
            
            const productName = row.querySelector('td:first-child .text-sm').textContent.toLowerCase();
            const brandText = row.querySelector('td:nth-child(2) .bg-blue-100').textContent.toLowerCase();
            const categoryText = row.querySelector('td:nth-child(2) .bg-gray-100').textContent.toLowerCase();
            const characteristics = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            
            let visible = true;
            
            // Filtro de búsqueda
            if (filters.search && !productName.includes(filters.search)) {
                visible = false;
            }
            
            // Filtro de marca
            if (filters.brand && !brandText.includes(filters.brand)) {
                visible = false;
            }
            
            // Filtro de categoría
            if (filters.category && !categoryText.includes(filters.category)) {
                visible = false;
            }
            
            // Filtro de características
            if (filters.characteristic) {
                const charMap = {
                    'eco_friendly': '🌿',
                    'antibacterial': '🦠',
                    'antiviral': '🛡️',
                    'biodegradable': '♻️',
                    'food_safe': '🍎',
                    'no_residue': '✨'
                };
                
                if (!characteristics.includes(charMap[filters.characteristic] || filters.characteristic)) {
                    visible = false;
                }
            }
            
            row.style.display = visible ? '' : 'none';
            if (visible) visibleCount++;
        });
        
        // Actualizar contador
        updateProductCount(visibleCount);
    }
    
    function updateProductCount(count) {
        const footer = document.querySelector('.px-6.py-4 .text-center');
        if (footer) {
            const total = tableRows.length - 1; // -1 para excluir la fila de estado vacío
            footer.textContent = `Mostrando ${count} de ${total} productos`;
        }
    }
    
    // Debounce para el campo de búsqueda
    let searchTimeout;
    function debouncedSearch() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(applyFilters, 300);
    }
    
    brandFilter.addEventListener('change', applyFilters);
    categoryFilter.addEventListener('change', applyFilters);
    characteristicFilter.addEventListener('change', applyFilters);
    searchFilter.addEventListener('input', debouncedSearch);
    
    // Limpiar filtros
    function clearFilters() {
        brandFilter.value = '';
        categoryFilter.value = '';
        characteristicFilter.value = '';
        searchFilter.value = '';
        applyFilters();
    }
    
    // Agregar botón de limpiar filtros si no existe
    const filtersContainer = document.querySelector('.flex.flex-wrap.items-center.gap-3');
    if (filtersContainer && !document.getElementById('clearFilters')) {
        const clearButton = document.createElement('button');
        clearButton.id = 'clearFilters';
        clearButton.className = 'text-sm text-gray-500 hover:text-gray-700 underline';
        clearButton.textContent = 'Limpiar filtros';
        clearButton.addEventListener('click', clearFilters);
        filtersContainer.appendChild(clearButton);
    }

    // Funcionalidad de selección masiva
    const selectAllCheckbox = document.getElementById('selectAll');
    const productCheckboxes = document.querySelectorAll('.product-checkbox');
    
    selectAllCheckbox.addEventListener('change', function() {
        productCheckboxes.forEach(checkbox => {
            if (checkbox.closest('tr').style.display !== 'none') {
                checkbox.checked = this.checked;
            }
        });
        updateSelectionStatus();
    });
    
    productCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectionStatus);
    });
    
    function updateSelectionStatus() {
        const visibleCheckboxes = Array.from(productCheckboxes).filter(cb => 
            cb.closest('tr').style.display !== 'none'
        );
        const checkedCount = visibleCheckboxes.filter(cb => cb.checked).length;
        
        selectAllCheckbox.checked = checkedCount > 0 && checkedCount === visibleCheckboxes.length;
        selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < visibleCheckboxes.length;
        
        // Mostrar/ocultar acciones masivas
        updateBulkActions(checkedCount);
    }
    
    function updateBulkActions(selectedCount) {
        // Aquí puedes mostrar/ocultar botones de acciones masivas según la selección
        if (selectedCount > 0) {
            console.log(`${selectedCount} productos seleccionados`);
        }
    }
    
    function getSelectedProducts() {
        return Array.from(productCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);
    }
});
</script>
@endsection