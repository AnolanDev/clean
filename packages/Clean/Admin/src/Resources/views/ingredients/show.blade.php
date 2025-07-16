@extends('clean-admin::layouts.admin')

@section('title', 'Ingrediente: ' . $ingredient->name)

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-12 w-12 bg-emerald-100 rounded-lg flex items-center justify-center mr-4">
                        <span class="text-emerald-600 font-medium text-xl">🧪</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $ingredient->name }}</h1>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ $ingredient->chemical_name ?? 'Sin nombre químico' }}
                            @if($ingredient->cas_number)
                                • CAS: {{ $ingredient->cas_number }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0 flex gap-2">
                    <a href="{{ route('admin.clean.ingredients.edit', $ingredient) }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Editar
                    </a>
                    <a href="{{ route('admin.clean.ingredients.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Información Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Información básica -->
        <div class="lg:col-span-2 bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">📋 Información Básica</h3>
                
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $ingredient->name }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tipo/Función</label>
                            <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ ucfirst($ingredient->type) }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre Químico</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $ingredient->chemical_name ?? 'No especificado' }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Número CAS</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $ingredient->cas_number ?? 'No especificado' }}</p>
                        </div>
                    </div>

                    @if($ingredient->description)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Descripción</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $ingredient->description }}</p>
                        </div>
                    @endif

                    <!-- Concentración -->
                    @if($ingredient->concentration_min || $ingredient->concentration_max)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rango de Concentración</label>
                            <div class="mt-1 flex items-center space-x-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $ingredient->concentration_min ?? 0 }}% - {{ $ingredient->concentration_max ?? 100 }}%
                                </span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Propiedades y Seguridad -->
        <div class="space-y-6">
            <!-- Nivel de Seguridad -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">⚠️ Seguridad</h3>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nivel de Seguridad</label>
                            <div class="mt-1">
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
                        </div>

                        @if($ingredient->hazard_symbols && count($ingredient->hazard_symbols) > 0)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Símbolos de Peligro</label>
                                <div class="mt-1 flex flex-wrap gap-1">
                                    @foreach($ingredient->hazard_symbols as $symbol)
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-700">
                                            {{ ucfirst($symbol) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($ingredient->safety_instructions)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Instrucciones de Seguridad</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $ingredient->safety_instructions }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Propiedades -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">🌿 Propiedades</h3>
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Origen</span>
                            @if($ingredient->is_natural)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    🌿 Natural
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    🧬 Sintético
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Biodegradabilidad</span>
                            @if($ingredient->is_biodegradable)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    ♻️ Biodegradable
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    🚫 No biodegradable
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">📊 Estadísticas</h3>
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Productos</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                {{ $ingredient->products_count }} productos
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Registrado</span>
                            <span class="text-sm text-gray-900">{{ $ingredient->created_at->format('d/m/Y') }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Actualizado</span>
                            <span class="text-sm text-gray-900">{{ $ingredient->updated_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Productos que usan este ingrediente -->
    @if($recentProducts->count() > 0)
        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">🧽 Productos que usan este ingrediente</h3>
                    <span class="text-sm text-gray-500">{{ $ingredient->products_count }} productos total</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($recentProducts as $product)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <span class="text-blue-600 font-medium text-sm">🧽</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900 truncate">
                                        <a href="{{ route('admin.clean.products.show', $product) }}" class="hover:text-blue-600">
                                            {{ $product->name }}
                                        </a>
                                    </h4>
                                    <p class="text-sm text-gray-500">
                                        {{ $product->brand->name ?? 'Sin marca' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($ingredient->products_count > 10)
                    <div class="mt-4 text-center">
                        <a href="{{ route('admin.clean.products.index', ['ingredient' => $ingredient->id]) }}" 
                           class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                            Ver todos los productos ({{ $ingredient->products_count }})
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Ingredientes similares -->
    @if($similarIngredients->count() > 0)
        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">🔗 Ingredientes similares</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($similarIngredients as $similar)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 h-10 w-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                    <span class="text-emerald-600 font-medium text-sm">🧪</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900 truncate">
                                        <a href="{{ route('admin.clean.ingredients.show', $similar) }}" class="hover:text-emerald-600">
                                            {{ $similar->name }}
                                        </a>
                                    </h4>
                                    <p class="text-sm text-gray-500">
                                        {{ ucfirst($similar->type) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Acciones -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <div class="px-4 py-3 sm:px-6">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
                <div class="flex gap-2">
                    <a href="{{ route('admin.clean.ingredients.edit', $ingredient) }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Editar
                    </a>
                    
                    <button onclick="exportIngredient()" 
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Exportar
                    </button>
                </div>

                <form method="POST" action="{{ route('admin.clean.ingredients.destroy', $ingredient) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('¿Estás seguro de eliminar este ingrediente?')"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function exportIngredient() {
        window.location.href = "{{ route('admin.clean.ingredients.export') }}?ingredient_ids[]={{ $ingredient->id }}";
    }
</script>
@endpush
@endsection