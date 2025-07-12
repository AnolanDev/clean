@extends('clean-admin::layouts.admin')

@section('title', 'Marca: ' . $brand->name)

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Compacto -->
    <div class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.clean.brands.index') }}" class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center justify-center transition-colors duration-200">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                @if($brand->logo)
                    <div class="w-10 h-10 rounded-lg overflow-hidden">
                        <img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"></path>
                        </svg>
                    </div>
                @endif
                <div>
                    <div class="flex items-center space-x-2">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $brand->name }}</h1>
                        @if($brand->is_eco_friendly)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                Ecológica
                            </span>
                        @endif
                        @if($brand->status)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Activa
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Inactiva
                            </span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-500">{{ $brand->products_count ?? 0 }} productos • Creada {{ $brand->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <div class="text-right">
                <span class="text-xs text-gray-500">Detalle de Marca</span>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="px-6 py-4 bg-white border-b border-gray-200">
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.clean.brands.edit', $brand) }}" 
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span class="hidden sm:inline">Editar Marca</span>
                <span class="sm:hidden">Editar</span>
            </a>

            @if($brand->website)
                <a href="{{ $brand->website }}" target="_blank" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span class="hidden sm:inline">Visitar Sitio</span>
                    <span class="sm:hidden">Web</span>
                </a>
            @endif

            <button onclick="confirmDelete()" 
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                <span class="hidden sm:inline">Eliminar</span>
            </button>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="px-4 py-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Columna Principal -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Información General -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Información General</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        @if($brand->description)
                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-700 mb-2">Descripción</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $brand->description }}</p>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-sm font-medium text-gray-700 mb-2">Slug (URL)</h3>
                                <p class="text-gray-600 font-mono text-sm bg-gray-50 px-3 py-2 rounded border">{{ $brand->slug }}</p>
                            </div>

                            @if($brand->country)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-700 mb-2">País de Origen</h3>
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $brand->country }}
                                    </div>
                                </div>
                            @endif

                            @if($brand->website)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-700 mb-2">Sitio Web</h3>
                                    <a href="{{ $brand->website }}" target="_blank" class="text-blue-600 hover:text-blue-700 text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                        {{ $brand->website }}
                                    </a>
                                </div>
                            @endif

                            <div>
                                <h3 class="text-sm font-medium text-gray-700 mb-2">Orden de Visualización</h3>
                                <p class="text-gray-600">{{ $brand->sort_order ?? 0 }}</p>
                            </div>
                        </div>

                        @if($brand->certifications && count($brand->certifications) > 0)
                            <div class="mt-6">
                                <h3 class="text-sm font-medium text-gray-700 mb-3">Certificaciones</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($brand->certifications as $certification)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $certification }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Productos de la Marca -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-semibold text-gray-900">Productos de la Marca</h2>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $brand->products_count ?? 0 }} productos
                            </span>
                        </div>
                    </div>

                    @if(isset($recentProducts) && $recentProducts->count() > 0)
                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach($recentProducts as $product)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            @if($product->image)
                                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-10 h-10 rounded-lg object-cover mr-3">
                                            @else
                                                <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center mr-3">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-900">{{ $product->name }}</h4>
                                                <p class="text-xs text-gray-500">Creado {{ $product->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('admin.clean.products.show', $product) }}" class="text-blue-600 hover:text-blue-700 text-sm">
                                            Ver
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            
                            @if($brand->products_count > 5)
                                <div class="mt-4 text-center">
                                    <a href="{{ route('admin.clean.products.index', ['brand' => $brand->slug]) }}" 
                                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-medium transition-colors duration-200">
                                        Ver todos los productos ({{ $brand->products_count }})
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="p-6 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No hay productos</h3>
                            <p class="mt-1 text-sm text-gray-500">Esta marca aún no tiene productos asociados.</p>
                            <div class="mt-6">
                                <a href="{{ route('admin.clean.products.create', ['brand' => $brand->slug]) }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-emerald-500 hover:bg-emerald-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Crear Primer Producto
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                
                <!-- Logo -->
                @if($brand->logo)
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-semibold text-gray-900">Logo de la Marca</h2>
                        </div>
                        <div class="p-6 text-center">
                            <img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}" class="w-32 h-32 object-contain mx-auto rounded-lg border border-gray-200">
                            <p class="mt-2 text-xs text-gray-500">{{ basename($brand->logo) }}</p>
                        </div>
                    </div>
                @endif

                <!-- Estadísticas -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-900">Estadísticas</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Total de Productos</span>
                            <span class="text-sm font-medium text-gray-900">{{ $brand->products_count ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Estado</span>
                            @if($brand->status)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Activa
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Inactiva
                                </span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Tipo</span>
                            @if($brand->is_eco_friendly)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Ecológica
                                </span>
                            @else
                                <span class="text-sm text-gray-500">Convencional</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Metadatos -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-900">Información del Sistema</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <span class="text-sm text-gray-600">ID de la Marca</span>
                            <p class="text-sm font-medium text-gray-900 font-mono">{{ $brand->id }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Fecha de Creación</span>
                            <p class="text-sm font-medium text-gray-900">{{ $brand->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Última Actualización</span>
                            <p class="text-sm font-medium text-gray-900">{{ $brand->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Última Modificación</span>
                            <p class="text-sm text-gray-500">{{ $brand->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulario para eliminar (oculto) -->
<form id="deleteForm" method="POST" action="{{ route('admin.clean.brands.destroy', $brand) }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
function confirmDelete() {
    if (confirm('¿Estás seguro de que quieres eliminar la marca "{{ $brand->name }}"?\n\nEsta acción no se puede deshacer.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endpush