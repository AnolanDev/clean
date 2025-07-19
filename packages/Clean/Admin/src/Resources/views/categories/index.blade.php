@extends('clean-admin::layouts.admin')

@section('title', 'Gestión de Categorías')

@section('content')
<div class="space-y-6">
    <!-- Header con estadísticas -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">🏷️ Gestión de Categorías</h1>
                    <p class="mt-1 text-sm text-gray-500">Organiza y administra las categorías de productos de limpieza</p>
                </div>
                <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row sm:items-center gap-3">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
                        <div class="bg-gray-50 px-3 py-2 rounded-lg">
                            <div class="text-lg font-semibold text-gray-900">{{ $totalCategories }}</div>
                            <div class="text-xs text-gray-500">Total</div>
                        </div>
                        <div class="bg-emerald-50 px-3 py-2 rounded-lg">
                            <div class="text-lg font-semibold text-emerald-600">{{ $activeCategories }}</div>
                            <div class="text-xs text-emerald-600">Activas</div>
                        </div>
                        <div class="bg-blue-50 px-3 py-2 rounded-lg">
                            <div class="text-lg font-semibold text-blue-600">{{ $rootCategories }}</div>
                            <div class="text-xs text-blue-600">Principales</div>
                        </div>
                        <div class="bg-purple-50 px-3 py-2 rounded-lg">
                            <div class="text-lg font-semibold text-purple-600">{{ $professionalCategories }}</div>
                            <div class="text-xs text-purple-600">Profesional</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros y Acciones -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <div class="px-4 py-4 border-b border-gray-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <!-- Botones de acción principales -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <a href="{{ route('admin.clean.categories.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="hidden sm:inline">Nueva Categoría</span>
                        <span class="sm:hidden">Nueva</span>
                    </a>
                    
                    <button onclick="toggleBulkActions()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span class="hidden sm:inline">Acciones Masivas</span>
                        <span class="sm:hidden">Masivas</span>
                    </button>
                    
                    <a href="{{ route('admin.clean.categories.export') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="hidden sm:inline">Exportar</span>
                        <span class="sm:hidden">📥</span>
                    </a>
                </div>

                <!-- Buscador móvil -->
                <div class="lg:hidden">
                    <form id="filters-form-mobile" method="GET" action="{{ route('admin.clean.categories.index') }}">
                        <div class="relative">
                            <input type="text" name="search" id="search-mobile" value="{{ $filters['search'] ?? '' }}" 
                                   placeholder="Buscar categorías..." 
                                   class="auto-filter w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500"
                                   data-delay="500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Filtros avanzados desktop -->
        <div class="hidden lg:block px-4 py-4 bg-gray-50 border-b border-gray-200">
            @php
                $hasFilters = collect($filters)->filter(fn($value) => !empty($value))->isNotEmpty();
            @endphp
            
            @if($hasFilters)
                <div class="mb-4 flex items-center justify-between rounded-md bg-blue-50 p-3">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z" />
                        </svg>
                        <span class="ml-2 text-sm font-medium text-blue-900">
                            Filtros aplicados: {{ collect($filters)->filter(fn($value) => !empty($value))->count() }}
                        </span>
                    </div>
                    <a href="{{ route('admin.clean.categories.index') }}" 
                       class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        Limpiar filtros
                    </a>
                </div>
            @endif
            
            <form id="filters-form" method="GET" action="{{ route('admin.clean.categories.index') }}" class="grid grid-cols-1 md:grid-cols-7 gap-4">
                <div>
                    <input type="text" name="search" id="search" value="{{ $filters['search'] ?? '' }}" 
                           placeholder="Buscar..." 
                           class="auto-filter w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500"
                           data-delay="500">
                </div>
                
                <div>
                    <select name="usage_area" class="auto-filter w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">Área de uso</option>
                        @foreach($usageAreas as $area)
                            <option value="{{ $area }}" {{ ($filters['usage_area'] ?? '') === $area ? 'selected' : '' }}>
                                {{ $area }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <select name="surface_type" class="auto-filter w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">Tipo superficie</option>
                        @foreach($surfaceTypes as $type)
                            <option value="{{ $type }}" {{ ($filters['surface_type'] ?? '') === $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <select name="parent_id" class="auto-filter w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">Categoría padre</option>
                        <option value="root" {{ ($filters['parent_id'] ?? '') === 'root' ? 'selected' : '' }}>
                            Solo principales
                        </option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}" {{ ($filters['parent_id'] ?? '') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <select name="status" class="auto-filter w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">Estado</option>
                        <option value="1" {{ ($filters['status'] ?? '') === '1' ? 'selected' : '' }}>Activa</option>
                        <option value="0" {{ ($filters['status'] ?? '') === '0' ? 'selected' : '' }}>Inactiva</option>
                    </select>
                </div>

                <div>
                    <select name="professional_use" class="auto-filter w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">Uso profesional</option>
                        <option value="1" {{ ($filters['professional_use'] ?? '') === '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ ($filters['professional_use'] ?? '') === '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

            </form>
        </div>

        <!-- Acciones masivas (oculto por defecto) -->
        <div id="bulk-actions" class="hidden px-4 py-3 bg-yellow-50 border-b border-yellow-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="text-sm text-yellow-800">
                    <span id="selected-count">0</span> categorías seleccionadas
                </div>
                <div class="flex flex-wrap gap-2">
                    <button onclick="bulkAction('activate')" class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1 rounded text-sm">
                        Activar
                    </button>
                    <button onclick="bulkAction('deactivate')" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm">
                        Desactivar
                    </button>
                    <button onclick="bulkAction('toggle_professional')" class="bg-purple-500 hover:bg-purple-600 text-white px-3 py-1 rounded text-sm">
                        Alternar Profesional
                    </button>
                    <button onclick="bulkAction('export')" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                        Exportar
                    </button>
                    <button onclick="bulkAction('delete')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de categorías -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
        @if($categories->count() > 0)
            <!-- Vista desktop -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left">
                                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Categoría
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jerarquía
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Uso/Superficie
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Productos
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" 
                                           class="category-checkbox rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($category->image)
                                                <img class="h-10 w-10 rounded-lg object-cover" 
                                                     src="{{ Storage::url($category->image) }}" 
                                                     alt="{{ $category->name }}">
                                            @else
                                                <div class="h-10 w-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                                                    <span class="text-emerald-600 font-medium text-sm">
                                                        {{ $category->icon ?? '🏷️' }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="{{ route('admin.clean.categories.show', $category) }}" class="hover:text-emerald-600">
                                                    {{ $category->name }}
                                                </a>
                                            </div>
                                            <div class="text-sm text-gray-500">{{ $category->slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        @if($category->parent)
                                            <span class="text-gray-400">↳</span> {{ $category->parent->name }}
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Principal
                                            </span>
                                        @endif
                                    </div>
                                    @if($category->children_count > 0)
                                        <div class="text-xs text-gray-500">
                                            {{ $category->children_count }} subcategorías
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        @if($category->usage_area)
                                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $category->usage_area }}
                                            </div>
                                        @endif
                                        @if($category->surface_type)
                                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                {{ $category->surface_type }}
                                            </div>
                                        @endif
                                        @if($category->professional_use)
                                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                Profesional
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        {{ $category->products_count }} productos
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($category->status)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Activa
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Inactiva
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.clean.categories.show', $category) }}" 
                                           class="bg-blue-500 hover:bg-blue-600 text-white w-8 h-8 rounded-lg flex items-center justify-center transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.clean.categories.edit', $category) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white w-8 h-8 rounded-lg flex items-center justify-center transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('admin.clean.categories.destroy', $category) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('¿Estás seguro de eliminar esta categoría?')"
                                                    class="bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-lg flex items-center justify-center transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Vista móvil -->
            <div class="lg:hidden">
                @foreach($categories as $category)
                    <div class="border-b border-gray-200 p-4">
                        <div class="flex items-start space-x-3">
                            <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" 
                                   class="category-checkbox mt-1 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                            
                            <div class="flex-shrink-0">
                                @if($category->image)
                                    <img class="h-12 w-12 rounded-lg object-cover" 
                                         src="{{ Storage::url($category->image) }}" 
                                         alt="{{ $category->name }}">
                                @else
                                    <div class="h-12 w-12 rounded-lg bg-emerald-100 flex items-center justify-center">
                                        <span class="text-emerald-600 font-medium">
                                            {{ $category->icon ?? '🏷️' }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">
                                        <a href="{{ route('admin.clean.categories.show', $category) }}" class="hover:text-emerald-600">
                                            {{ $category->name }}
                                        </a>
                                    </h3>
                                    <div class="flex items-center space-x-1 ml-2">
                                        <a href="{{ route('admin.clean.categories.show', $category) }}" 
                                           class="bg-blue-500 hover:bg-blue-600 text-white w-8 h-8 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.clean.categories.edit', $category) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white w-8 h-8 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="mt-1 flex items-center space-x-2 text-sm text-gray-500">
                                    @if($category->parent)
                                        <span class="text-gray-400">↳</span>
                                        <span>{{ $category->parent->name }}</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Principal
                                        </span>
                                    @endif
                                </div>

                                <div class="mt-2 flex flex-wrap gap-1">
                                    @if($category->usage_area)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $category->usage_area }}
                                        </span>
                                    @endif
                                    @if($category->surface_type)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            {{ $category->surface_type }}
                                        </span>
                                    @endif
                                    @if($category->professional_use)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            Profesional
                                        </span>
                                    @endif
                                </div>

                                <div class="mt-2 flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                            {{ $category->products_count }} productos
                                        </span>
                                        @if($category->children_count > 0)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $category->children_count }} subcategorías
                                            </span>
                                        @endif
                                    </div>
                                    
                                    @if($category->status)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Activa
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Inactiva
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $categories->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay categorías</h3>
                <p class="mt-1 text-sm text-gray-500">Comienza creando tu primera categoría de productos.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.clean.categories.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Nueva Categoría
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Configuración para filtros automáticos
    let filterTimeout;
    const AUTO_FILTER_DELAY = 500; // 500ms de debounce para búsqueda
    
    // Inicializar filtros automáticos y funciones de bulk
    document.addEventListener('DOMContentLoaded', function() {
        initAutoFilters();
        initBulkActions();
        restoreFocus();
    });
    
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
        // Determinar qué formulario usar (desktop o móvil)
        const form = document.getElementById('filters-form') || document.getElementById('filters-form-mobile');
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
    
    function showLoadingIndicator() {
        // Ya no necesitamos mostrar indicador de carga ya que los filtros son automáticos
        // Esta función se mantiene para compatibilidad pero no hace nada
    }

    function initBulkActions() {
        // Toggle bulk actions
        window.toggleBulkActions = function() {
            const bulkActions = document.getElementById('bulk-actions');
            bulkActions.classList.toggle('hidden');
            updateSelectedCount();
        };

        // Select all checkboxes
        document.getElementById('select-all')?.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.category-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectedCount();
        });

        // Add event listeners to checkboxes
        document.querySelectorAll('.category-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });
    }

    // Update selected count
    function updateSelectedCount() {
        const checkedBoxes = document.querySelectorAll('.category-checkbox:checked');
        const count = checkedBoxes.length;
        document.getElementById('selected-count').textContent = count;
        
        if (count > 0) {
            document.getElementById('bulk-actions').classList.remove('hidden');
        } else {
            document.getElementById('bulk-actions').classList.add('hidden');
        }
    }

    // Bulk actions
    function bulkAction(action) {
        const checkedBoxes = document.querySelectorAll('.category-checkbox:checked');
        const categoryIds = Array.from(checkedBoxes).map(cb => cb.value);
        
        if (categoryIds.length === 0) {
            alert('Selecciona al menos una categoría');
            return;
        }

        if (action === 'delete' && !confirm(`¿Estás seguro de eliminar ${categoryIds.length} categorías?`)) {
            return;
        }

        fetch('{{ route("admin.clean.categories.bulk-action") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                action: action,
                category_ids: categoryIds
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                if (action === 'export') {
                    // Handle export download
                    window.location.href = data.download_url;
                } else {
                    window.location.reload();
                }
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error en la operación');
        });
    }
</script>
@endpush
@endsection