@extends('clean-admin::layouts.admin')

@section('title', 'Producto: ' . $product->name)

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                    {{ strtoupper(substr($product->name, 0, 2)) }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                    <p class="text-gray-600">ID: {{ $product->id }} | {{ $product->brand?->name ?? 'Sin marca' }}</p>
                </div>
            </div>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.clean.products.edit', $product) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Editar
            </a>
            <a href="{{ route('admin.clean.products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a Productos
            </a>
        </div>
    </div>

    <!-- Alertas de Seguridad -->
    @if($product->safety_classification !== 'non_hazardous')
        <div class="mb-6 p-4 rounded-lg border-l-4 
            @if($product->safety_classification === 'toxic' || $product->safety_classification === 'corrosive')
                bg-red-50 border-red-400
            @elseif($product->safety_classification === 'irritant' || $product->safety_classification === 'flammable')
                bg-yellow-50 border-yellow-400
            @endif">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 
                        @if($product->safety_classification === 'toxic' || $product->safety_classification === 'corrosive')
                            text-red-400
                        @else
                            text-yellow-400
                        @endif" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm 
                        @if($product->safety_classification === 'toxic' || $product->safety_classification === 'corrosive')
                            text-red-800
                        @else
                            text-yellow-800
                        @endif">
                        <strong>Producto {{ ucfirst($product->safety_classification) }}:</strong> 
                        Este producto requiere precauciones especiales de manejo y almacenamiento.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna Principal -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Información Básica -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Información General</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Categoría</h3>
                        <div class="flex items-center">
                            <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-gray-100 text-gray-800">
                                {{ $product->category?->name ?? 'Sin categoría' }}
                            </span>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Tipo de Producto</h3>
                        <div class="flex items-center">
                            <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                                @switch($product->product_type)
                                    @case('liquid') 🧴 Líquido @break
                                    @case('powder') 📦 Polvo @break
                                    @case('gel') 🫧 Gel @break
                                    @case('spray') 💨 Spray @break
                                    @case('foam') 🧽 Espuma @break
                                    @case('paste') 🧴 Pasta @break
                                    @case('crystal') 💎 Cristal @break
                                    @default {{ ucfirst($product->product_type) }}
                                @endswitch
                            </span>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Clasificación de Seguridad</h3>
                        <div class="flex items-center">
                            @switch($product->safety_classification)
                                @case('non_hazardous')
                                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800">
                                        ✅ No peligroso
                                    </span>
                                    @break
                                @case('irritant')
                                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-yellow-100 text-yellow-800">
                                        ⚠️ Irritante
                                    </span>
                                    @break
                                @case('corrosive')
                                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-red-100 text-red-800">
                                        🔥 Corrosivo
                                    </span>
                                    @break
                                @case('toxic')
                                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-red-100 text-red-800">
                                        ☠️ Tóxico
                                    </span>
                                    @break
                                @case('flammable')
                                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-orange-100 text-orange-800">
                                        🔥 Inflamable
                                    </span>
                                    @break
                                @default
                                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-gray-100 text-gray-800">
                                        {{ ucfirst($product->safety_classification) }}
                                    </span>
                            @endswitch
                        </div>
                    </div>

                    @if($product->ph_level || $product->ph_value)
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">pH</h3>
                            <div class="text-sm text-gray-900">
                                @if($product->ph_value)
                                    <span class="font-medium">{{ $product->ph_value }}</span>
                                @endif
                                @if($product->ph_level)
                                    <span class="ml-2 text-gray-600">({{ ucfirst($product->ph_level) }})</span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                @if($product->description)
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Descripción</h3>
                        <p class="text-gray-900">{{ $product->description }}</p>
                    </div>
                @endif

                @if($product->benefits)
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Beneficios</h3>
                        <p class="text-gray-900">{{ $product->benefits }}</p>
                    </div>
                @endif
            </div>

            <!-- Características Especiales -->
            @php
                $characteristics = [
                    'is_eco_friendly' => ['Ecológico', 'bg-green-100', 'text-green-800', '🌿'],
                    'is_biodegradable' => ['Biodegradable', 'bg-green-100', 'text-green-800', '♻️'],
                    'is_concentrated' => ['Concentrado', 'bg-purple-100', 'text-purple-800', '💧'],
                    'is_antibacterial' => ['Antibacterial', 'bg-red-100', 'text-red-800', '🦠'],
                    'is_antiviral' => ['Antiviral', 'bg-red-100', 'text-red-800', '🛡️'],
                    'is_antifungal' => ['Antifúngico', 'bg-red-100', 'text-red-800', '🍄'],
                    'food_contact_safe' => ['Seguro para alimentos', 'bg-blue-100', 'text-blue-800', '🍎'],
                    'no_residue' => ['Sin residuos', 'bg-purple-100', 'text-purple-800', '✨'],
                    'fabric_safe' => ['Seguro para textiles', 'bg-indigo-100', 'text-indigo-800', '👕'],
                    'is_phosphate_free' => ['Sin fosfatos', 'bg-green-100', 'text-green-800', '🚫'],
                    'is_chlorine_free' => ['Sin cloro', 'bg-green-100', 'text-green-800', '🚫'],
                    'is_ammonia_free' => ['Sin amoníaco', 'bg-green-100', 'text-green-800', '🚫'],
                    'is_fragrance_free' => ['Sin fragancia', 'bg-gray-100', 'text-gray-800', '👃']
                ];
                
                $activeCharacteristics = collect($characteristics)->filter(function($data, $key) use ($product) {
                    return $product->$key;
                });
            @endphp

            @if($activeCharacteristics->count() > 0)
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Características Especiales</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($activeCharacteristics as $key => $data)
                            <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full {{ $data[1] }} {{ $data[2] }}">
                                {{ $data[3] }} {{ $data[0] }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Presentaciones y Especificaciones -->
            @if($product->presentations || $product->available_fragrances || $product->usage_types)
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Presentaciones y Usos</h2>
                    <div class="space-y-6">
                        @if($product->presentations && count($product->presentations) > 0)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-3">Presentaciones Disponibles</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($product->presentations as $presentation)
                                        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800">
                                            {{ $presentation }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($product->available_fragrances && count($product->available_fragrances) > 0)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-3">Aromas Disponibles</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($product->available_fragrances as $fragrance)
                                        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-pink-100 text-pink-800">
                                            🌸 {{ $fragrance }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($product->usage_types && count($product->usage_types) > 0)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-3">Tipos de Uso</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($product->usage_types as $usage)
                                        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                                            🏢 {{ $usage }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Instrucciones de Uso y Seguridad -->
            @if($product->usage_instructions || $product->precautions || $product->first_aid || $product->storage_conditions)
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Instrucciones y Seguridad</h2>
                    <div class="space-y-6">
                        @if($product->usage_instructions)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Instrucciones de Uso</h3>
                                <p class="text-gray-900 whitespace-pre-line">{{ $product->usage_instructions }}</p>
                            </div>
                        @endif

                        @if($product->precautions)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Precauciones</h3>
                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                    <p class="text-yellow-800 whitespace-pre-line">{{ $product->precautions }}</p>
                                </div>
                            </div>
                        @endif

                        @if($product->first_aid)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Primeros Auxilios</h3>
                                <div class="bg-red-50 border-l-4 border-red-400 p-4">
                                    <p class="text-red-800 whitespace-pre-line">{{ $product->first_aid }}</p>
                                </div>
                            </div>
                        @endif

                        @if($product->storage_conditions)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Condiciones de Almacenamiento</h3>
                                <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                                    <p class="text-blue-800 whitespace-pre-line">{{ $product->storage_conditions }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Ingredientes -->
            @if($product->ingredients && $product->ingredients->count() > 0)
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Ingredientes</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ingrediente</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Concentración</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Función</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($product->ingredients as $ingredient)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $ingredient->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $ingredient->pivot->concentration ? $ingredient->pivot->concentration . '%' : '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $ingredient->pivot->function_in_product ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($ingredient->pivot->is_active_ingredient)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Activo
                                                </span>
                                            @else
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Excipiente
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

        <!-- Barra Lateral -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Imágenes del Producto -->
            @if(!empty($product->images))
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Imágenes</h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($product->images as $image)
                            <img src="{{ Storage::url($image['path'] ?? '') }}" alt="Producto" 
                                 class="w-full h-24 object-cover rounded-lg border border-gray-200 cursor-pointer hover:opacity-75 transition-opacity"
                                 onclick="openImageModal('{{ Storage::url($image['path'] ?? '') }}')">
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Especificaciones Técnicas -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Especificaciones Técnicas</h3>
                <div class="space-y-4">
                    @if($product->dilution_ratio)
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Dilución</span>
                            <span class="text-sm font-medium text-gray-900">{{ $product->dilution_ratio }}</span>
                        </div>
                    @endif

                    @if($product->concentration_percentage)
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Concentración</span>
                            <span class="text-sm font-medium text-gray-900">{{ $product->concentration_percentage }}</span>
                        </div>
                    @endif

                    @if($product->color)
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Color</span>
                            <span class="text-sm font-medium text-gray-900">{{ $product->color }}</span>
                        </div>
                    @endif

                    @if($product->fragrance)
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Fragancia</span>
                            <span class="text-sm font-medium text-gray-900">{{ $product->fragrance }}</span>
                        </div>
                    @endif

                    @if($product->density)
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Densidad</span>
                            <span class="text-sm font-medium text-gray-900">{{ $product->density }} g/mL</span>
                        </div>
                    @endif

                    @if($product->shelf_life_months)
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Vida Útil</span>
                            <span class="text-sm font-medium text-gray-900">{{ $product->shelf_life_months }} meses</span>
                        </div>
                    @endif

                    @if($product->packaging_material)
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Material Envase</span>
                            <span class="text-sm font-medium text-gray-900">{{ $product->packaging_material }}</span>
                        </div>
                    @endif

                    @if($product->compatible_surfaces && count($product->compatible_surfaces) > 0)
                        <div class="py-2">
                            <span class="text-sm text-gray-600 block mb-2">Superficies Compatibles</span>
                            <div class="flex flex-wrap gap-1">
                                @foreach($product->compatible_surfaces as $surface)
                                    <span class="inline-flex px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                        {{ $surface }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Certificaciones -->
            @if($product->certifications && count($product->certifications) > 0)
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Certificaciones</h3>
                    <div class="space-y-2">
                        @foreach($product->certifications as $certification)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-gray-900">{{ $certification }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Información de Registro -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información del Registro</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="text-gray-600">Creado:</span>
                        <span class="text-gray-900 block">{{ $product->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Actualizado:</span>
                        <span class="text-gray-900 block">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    @if($product->catalog_source)
                        <div>
                            <span class="text-gray-600">Origen:</span>
                            <span class="inline-flex px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                {{ ucfirst(str_replace('_', ' ', $product->catalog_source)) }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Acciones</h3>
                <div class="space-y-3">
                    <button onclick="exportProduct()" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200 text-sm">
                        📄 Exportar Ficha Técnica
                    </button>
                    <button onclick="printProduct()" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200 text-sm">
                        🖨️ Imprimir Producto
                    </button>
                    <button onclick="duplicateProduct()" class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition duration-200 text-sm">
                        📋 Duplicar Producto
                    </button>
                    <button onclick="deleteProductConfirm()" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-200 text-sm">
                        🗑️ Eliminar Producto
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para imágenes -->
<div id="imageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-4xl w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Imagen del Producto</h3>
                <button onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="text-center">
                <img id="modalImage" src="" alt="Producto" class="max-w-full max-h-96 mx-auto rounded-lg">
            </div>
        </div>
    </div>
</div>

<script>
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

function exportProduct() {
    // Implementar exportación de ficha técnica
    alert('Funcionalidad de exportación en desarrollo');
}

function printProduct() {
    window.print();
}

function duplicateProduct() {
    if (confirm('¿Deseas crear una copia de este producto?')) {
        // Redirigir al formulario de creación con datos precargados
        window.location.href = '{{ route("admin.clean.products.create") }}?duplicate={{ $product->id }}';
    }
}

function deleteProductConfirm() {
    if (confirm('¿Estás seguro de que quieres eliminar este producto? Esta acción no se puede deshacer.')) {
        // Crear formulario para DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.clean.products.destroy", $product) }}';
        
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

// Cerrar modal al hacer clic fuera de él
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});
</script>
@endsection