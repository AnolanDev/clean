@extends('clean-admin::layouts.admin')

@section('title', 'Gestión de Ingredientes')

@section('content')
<div class="space-y-6">
    <!-- Header con estadísticas -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">🧪 Gestión de Ingredientes</h1>
                    <p class="mt-1 text-sm text-gray-500">Administra y supervisa los ingredientes de productos de limpieza</p>
                </div>
                <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row sm:items-center gap-3">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
                        <div class="bg-gray-50 px-3 py-2 rounded-lg">
                            <div class="text-lg font-semibold text-gray-900">{{ $totalIngredients }}</div>
                            <div class="text-xs text-gray-500">Total</div>
                        </div>
                        <div class="bg-green-50 px-3 py-2 rounded-lg">
                            <div class="text-lg font-semibold text-green-600">{{ $naturalIngredients }}</div>
                            <div class="text-xs text-green-600">Naturales</div>
                        </div>
                        <div class="bg-blue-50 px-3 py-2 rounded-lg">
                            <div class="text-lg font-semibold text-blue-600">{{ $biodegradableIngredients }}</div>
                            <div class="text-xs text-blue-600">Biodegradables</div>
                        </div>
                        <div class="bg-red-50 px-3 py-2 rounded-lg">
                            <div class="text-lg font-semibold text-red-600">{{ $hazardousIngredients }}</div>
                            <div class="text-xs text-red-600">Peligrosos</div>
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
                    <a href="{{ route('admin.clean.ingredients.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="hidden sm:inline">Nuevo Ingrediente</span>
                        <span class="sm:hidden">Nuevo</span>
                    </a>
                    
                    <button onclick="toggleBulkActions()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span class="hidden sm:inline">Acciones Masivas</span>
                        <span class="sm:hidden">Masivas</span>
                    </button>
                    
                    <a href="{{ route('admin.clean.ingredients.export') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="hidden sm:inline">Exportar</span>
                        <span class="sm:hidden">📥</span>
                    </a>
                </div>

                <!-- Buscador móvil -->
                <div class="lg:hidden">
                    <form method="GET" action="{{ route('admin.clean.ingredients.index') }}">
                        <div class="relative">
                            <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" 
                                   placeholder="Buscar ingredientes..." 
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
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
            <form method="GET" action="{{ route('admin.clean.ingredients.index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <div>
                    <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" 
                           placeholder="Buscar..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                
                <div>
                    <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">Tipo</option>
                        @foreach($ingredientTypes as $type)
                            <option value="{{ $type }}" {{ ($filters['type'] ?? '') === $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <select name="safety_level" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">Nivel seguridad</option>
                        @foreach($safetyLevels as $level)
                            <option value="{{ $level }}" {{ ($filters['safety_level'] ?? '') === $level ? 'selected' : '' }}>
                                {{ ucfirst($level) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <select name="is_natural" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">Origen</option>
                        <option value="1" {{ ($filters['is_natural'] ?? '') === '1' ? 'selected' : '' }}>Natural</option>
                        <option value="0" {{ ($filters['is_natural'] ?? '') === '0' ? 'selected' : '' }}>Sintético</option>
                    </select>
                </div>

                <div>
                    <select name="is_biodegradable" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">Biodegradable</option>
                        <option value="1" {{ ($filters['is_biodegradable'] ?? '') === '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ ($filters['is_biodegradable'] ?? '') === '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                        Filtrar
                    </button>
                    <a href="{{ route('admin.clean.ingredients.index') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 text-center">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>

        <!-- Acciones masivas (oculto por defecto) -->
        <div id="bulk-actions" class="hidden px-4 py-3 bg-yellow-50 border-b border-yellow-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="text-sm text-yellow-800">
                    <span id="selected-count">0</span> ingredientes seleccionados
                </div>
                <div class="flex flex-wrap gap-2">
                    <button onclick="bulkAction('mark_natural')" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                        Marcar Natural
                    </button>
                    <button onclick="bulkAction('mark_synthetic')" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm">
                        Marcar Sintético
                    </button>
                    <button onclick="bulkAction('mark_biodegradable')" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                        Marcar Biodegradable
                    </button>
                    <button onclick="bulkAction('export')" class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded text-sm">
                        Exportar
                    </button>
                    <button onclick="bulkAction('delete')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de ingredientes -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
        @if($ingredients->count() > 0)
            <!-- Vista desktop -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left">
                                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ingrediente
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipo/Función
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Seguridad
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Propiedades
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Productos
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($ingredients as $ingredient)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <input type="checkbox" name="ingredient_ids[]" value="{{ $ingredient->id }}" 
                                           class="ingredient-checkbox rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                                                <span class="text-emerald-600 font-medium text-sm">🧪</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="{{ route('admin.clean.ingredients.show', $ingredient) }}" class="hover:text-emerald-600">
                                                    {{ $ingredient->name }}
                                                </a>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $ingredient->chemical_name ?? 'Sin nombre químico' }}
                                            </div>
                                            @if($ingredient->cas_number)
                                                <div class="text-xs text-gray-400">CAS: {{ $ingredient->cas_number }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ ucfirst($ingredient->type) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        @switch($ingredient->safety_level)
                                            @case('low')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    ✅ Bajo
                                                </span>
                                                @break
                                            @case('medium')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    ⚠️ Medio
                                                </span>
                                                @break
                                            @case('high')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                    🔶 Alto
                                                </span>
                                                @break
                                            @case('hazardous')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    ☠️ Peligroso
                                                </span>
                                                @break
                                        @endswitch
                                        
                                        @if($ingredient->hazard_symbols && count($ingredient->hazard_symbols) > 0)
                                            <div class="flex flex-wrap gap-1 mt-1">
                                                @foreach($ingredient->hazard_symbols as $symbol)
                                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-red-100 text-red-700">
                                                        {{ ucfirst($symbol) }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        @if($ingredient->is_natural)
                                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                🌿 Natural
                                            </div>
                                        @else
                                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                🧬 Sintético
                                            </div>
                                        @endif
                                        
                                        @if($ingredient->is_biodegradable)
                                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                ♻️ Biodegradable
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        {{ $ingredient->products_count }} productos
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.clean.ingredients.show', $ingredient) }}" 
                                           class="bg-blue-500 hover:bg-blue-600 text-white w-8 h-8 rounded-lg flex items-center justify-center transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.clean.ingredients.edit', $ingredient) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white w-8 h-8 rounded-lg flex items-center justify-center transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('admin.clean.ingredients.destroy', $ingredient) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('¿Estás seguro de eliminar este ingrediente?')"
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
                @foreach($ingredients as $ingredient)
                    <div class="border-b border-gray-200 p-4">
                        <div class="flex items-start space-x-3">
                            <input type="checkbox" name="ingredient_ids[]" value="{{ $ingredient->id }}" 
                                   class="ingredient-checkbox mt-1 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                            
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 rounded-lg bg-emerald-100 flex items-center justify-center">
                                    <span class="text-emerald-600 font-medium text-lg">🧪</span>
                                </div>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">
                                        <a href="{{ route('admin.clean.ingredients.show', $ingredient) }}" class="hover:text-emerald-600">
                                            {{ $ingredient->name }}
                                        </a>
                                    </h3>
                                    <div class="flex items-center space-x-1 ml-2">
                                        <a href="{{ route('admin.clean.ingredients.show', $ingredient) }}" 
                                           class="bg-blue-500 hover:bg-blue-600 text-white w-8 h-8 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.clean.ingredients.edit', $ingredient) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white w-8 h-8 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="mt-1 text-sm text-gray-500">
                                    {{ $ingredient->chemical_name ?? 'Sin nombre químico' }}
                                </div>
                                
                                @if($ingredient->cas_number)
                                    <div class="mt-1 text-xs text-gray-400">CAS: {{ $ingredient->cas_number }}</div>
                                @endif

                                <div class="mt-2 flex flex-wrap gap-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ ucfirst($ingredient->type) }}
                                    </span>
                                    
                                    @switch($ingredient->safety_level)
                                        @case('low')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                ✅ Bajo
                                            </span>
                                            @break
                                        @case('medium')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                ⚠️ Medio
                                            </span>
                                            @break
                                        @case('high')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                🔶 Alto
                                            </span>
                                            @break
                                        @case('hazardous')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                ☠️ Peligroso
                                            </span>
                                            @break
                                    @endswitch
                                </div>

                                <div class="mt-2 flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        @if($ingredient->is_natural)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                🌿 Natural
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                🧬 Sintético
                                            </span>
                                        @endif
                                        
                                        @if($ingredient->is_biodegradable)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                ♻️ Biodegradable
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        {{ $ingredient->products_count }} productos
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $ingredients->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay ingredientes</h3>
                <p class="mt-1 text-sm text-gray-500">Comienza creando tu primer ingrediente.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.clean.ingredients.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Nuevo Ingrediente
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Toggle bulk actions
    function toggleBulkActions() {
        const bulkActions = document.getElementById('bulk-actions');
        bulkActions.classList.toggle('hidden');
        updateSelectedCount();
    }

    // Select all checkboxes
    document.getElementById('select-all')?.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.ingredient-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateSelectedCount();
    });

    // Update selected count
    function updateSelectedCount() {
        const checkedBoxes = document.querySelectorAll('.ingredient-checkbox:checked');
        const count = checkedBoxes.length;
        document.getElementById('selected-count').textContent = count;
        
        if (count > 0) {
            document.getElementById('bulk-actions').classList.remove('hidden');
        } else {
            document.getElementById('bulk-actions').classList.add('hidden');
        }
    }

    // Add event listeners to checkboxes
    document.querySelectorAll('.ingredient-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });

    // Bulk actions
    function bulkAction(action) {
        const checkedBoxes = document.querySelectorAll('.ingredient-checkbox:checked');
        const ingredientIds = Array.from(checkedBoxes).map(cb => cb.value);
        
        if (ingredientIds.length === 0) {
            alert('Selecciona al menos un ingrediente');
            return;
        }

        if (action === 'delete' && !confirm(`¿Estás seguro de eliminar ${ingredientIds.length} ingredientes?`)) {
            return;
        }

        fetch('{{ route("admin.clean.ingredients.bulk-action") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                action: action,
                ingredient_ids: ingredientIds
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