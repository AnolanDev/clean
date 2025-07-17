@extends('clean-admin::layouts.admin')

@section('title', 'Editar Producto')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Editar Producto</h1>
            <p class="text-gray-600 mt-2">{{ is_array($product->name) ? implode(' ', $product->name) : (string) $product->name }}</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.clean.products.show', $product) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                Ver Producto
            </a>
            <a href="{{ route('admin.clean.products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a Productos
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Hay errores en el formulario:</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.clean.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Información Básica -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Información Básica</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Producto *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', is_array($product->name) ? implode(' ', $product->name) : (string) $product->name) }}" required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="clean_brand_id" class="block text-sm font-medium text-gray-700 mb-2">Marca *</label>
                    <select id="clean_brand_id" name="clean_brand_id" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleccionar marca</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('clean_brand_id', $product->clean_brand_id) == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('clean_brand_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="clean_category_id" class="block text-sm font-medium text-gray-700 mb-2">Categoría *</label>
                    <select id="clean_category_id" name="clean_category_id" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleccionar categoría</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('clean_category_id', $product->clean_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('clean_category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="product_type" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Producto *</label>
                    <select id="product_type" name="product_type" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleccionar tipo</option>
                        <option value="liquid" {{ old('product_type', $product->product_type) == 'liquid' ? 'selected' : '' }}>Líquido</option>
                        <option value="powder" {{ old('product_type', $product->product_type) == 'powder' ? 'selected' : '' }}>Polvo</option>
                        <option value="gel" {{ old('product_type', $product->product_type) == 'gel' ? 'selected' : '' }}>Gel</option>
                        <option value="spray" {{ old('product_type', $product->product_type) == 'spray' ? 'selected' : '' }}>Spray</option>
                        <option value="foam" {{ old('product_type', $product->product_type) == 'foam' ? 'selected' : '' }}>Espuma</option>
                        <option value="paste" {{ old('product_type', $product->product_type) == 'paste' ? 'selected' : '' }}>Pasta</option>
                        <option value="crystal" {{ old('product_type', $product->product_type) == 'crystal' ? 'selected' : '' }}>Cristal</option>
                    </select>
                    @error('product_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="safety_classification" class="block text-sm font-medium text-gray-700 mb-2">Clasificación de Seguridad *</label>
                    <select id="safety_classification" name="safety_classification" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleccionar clasificación</option>
                        <option value="non_hazardous" {{ old('safety_classification', $product->safety_classification) == 'non_hazardous' ? 'selected' : '' }}>No peligroso</option>
                        <option value="irritant" {{ old('safety_classification', $product->safety_classification) == 'irritant' ? 'selected' : '' }}>Irritante</option>
                        <option value="corrosive" {{ old('safety_classification', $product->safety_classification) == 'corrosive' ? 'selected' : '' }}>Corrosivo</option>
                        <option value="toxic" {{ old('safety_classification', $product->safety_classification) == 'toxic' ? 'selected' : '' }}>Tóxico</option>
                        <option value="flammable" {{ old('safety_classification', $product->safety_classification) == 'flammable' ? 'selected' : '' }}>Inflamable</option>
                    </select>
                    @error('safety_classification')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', is_array($product->description) ? implode(' ', $product->description) : (string) $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="benefits" class="block text-sm font-medium text-gray-700 mb-2">Beneficios</label>
                    <textarea id="benefits" name="benefits" rows="2"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('benefits', is_array($product->benefits) ? implode(' ', $product->benefits) : (string) $product->benefits) }}</textarea>
                    @error('benefits')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Características del Producto -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Características</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Características booleanas -->
                <div class="space-y-4">
                    <h3 class="font-medium text-gray-900">Propiedades Especiales</h3>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_eco_friendly" value="1" {{ old('is_eco_friendly', $product->is_eco_friendly) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Ecológico</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_biodegradable" value="1" {{ old('is_biodegradable', $product->is_biodegradable) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Biodegradable</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_concentrated" value="1" {{ old('is_concentrated', $product->is_concentrated) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Concentrado</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="food_contact_safe" value="1" {{ old('food_contact_safe', $product->food_contact_safe) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Seguro para alimentos</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="no_residue" value="1" {{ old('no_residue', $product->no_residue) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Sin residuos</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="fabric_safe" value="1" {{ old('fabric_safe', $product->fabric_safe) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Seguro para textiles</span>
                        </label>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="font-medium text-gray-900">Propiedades Antimicrobianas</h3>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_antibacterial" value="1" {{ old('is_antibacterial', $product->is_antibacterial) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Antibacterial</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_antiviral" value="1" {{ old('is_antiviral', $product->is_antiviral) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Antiviral</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_antifungal" value="1" {{ old('is_antifungal', $product->is_antifungal) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Antifúngico</span>
                        </label>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="font-medium text-gray-900">Composición</h3>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_phosphate_free" value="1" {{ old('is_phosphate_free', $product->is_phosphate_free) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Sin fosfatos</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_chlorine_free" value="1" {{ old('is_chlorine_free', $product->is_chlorine_free) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Sin cloro</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_ammonia_free" value="1" {{ old('is_ammonia_free', $product->is_ammonia_free) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Sin amoníaco</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_fragrance_free" value="1" {{ old('is_fragrance_free', $product->is_fragrance_free) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Sin fragancia</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Presentaciones y Especificaciones -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Presentaciones y Especificaciones</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="presentations" class="block text-sm font-medium text-gray-700 mb-2">Presentaciones</label>
                    <input type="text" id="presentations" name="presentations" 
                           value="{{ old('presentations', is_array($product->presentations) ? implode(', ', $product->presentations) : '') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: 1L, 4L, 5L, 20L">
                    <p class="mt-1 text-sm text-gray-500">Separar con comas</p>
                </div>

                <div>
                    <label for="available_fragrances" class="block text-sm font-medium text-gray-700 mb-2">Aromas Disponibles</label>
                    <input type="text" id="available_fragrances" name="available_fragrances" 
                           value="{{ old('available_fragrances', is_array($product->available_fragrances) ? implode(', ', $product->available_fragrances) : '') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: Lavanda, Limón, Sin aroma">
                    <p class="mt-1 text-sm text-gray-500">Separar con comas</p>
                </div>

                <div>
                    <label for="usage_types" class="block text-sm font-medium text-gray-700 mb-2">Tipos de Uso</label>
                    <input type="text" id="usage_types" name="usage_types" 
                           value="{{ old('usage_types', is_array($product->usage_types) ? implode(', ', $product->usage_types) : '') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: Doméstico, Comercial, Industrial">
                    <p class="mt-1 text-sm text-gray-500">Separar con comas</p>
                </div>

                <div>
                    <label for="compatible_surfaces" class="block text-sm font-medium text-gray-700 mb-2">Superficies Compatibles</label>
                    <input type="text" id="compatible_surfaces" name="compatible_surfaces" 
                           value="{{ old('compatible_surfaces', is_array($product->compatible_surfaces) ? implode(', ', $product->compatible_surfaces) : '') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: Vidrio, Metal, Plástico">
                    <p class="mt-1 text-sm text-gray-500">Separar con comas</p>
                </div>

                <div>
                    <label for="ph_level" class="block text-sm font-medium text-gray-700 mb-2">Nivel de pH</label>
                    <select id="ph_level" name="ph_level"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleccionar nivel</option>
                        <option value="acidic" {{ old('ph_level', $product->ph_level) == 'acidic' ? 'selected' : '' }}>Ácido</option>
                        <option value="neutral" {{ old('ph_level', $product->ph_level) == 'neutral' ? 'selected' : '' }}>Neutro</option>
                        <option value="alkaline" {{ old('ph_level', $product->ph_level) == 'alkaline' ? 'selected' : '' }}>Alcalino</option>
                    </select>
                </div>

                <div>
                    <label for="ph_value" class="block text-sm font-medium text-gray-700 mb-2">Valor de pH</label>
                    <input type="number" id="ph_value" name="ph_value" value="{{ old('ph_value', $product->ph_value) }}"
                           min="0" max="14" step="0.1"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="dilution_ratio" class="block text-sm font-medium text-gray-700 mb-2">Dilución</label>
                    <input type="text" id="dilution_ratio" name="dilution_ratio" value="{{ old('dilution_ratio', $product->dilution_ratio) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: 1:10, 1:100">
                </div>

                <div>
                    <label for="concentration_percentage" class="block text-sm font-medium text-gray-700 mb-2">Concentración</label>
                    <input type="text" id="concentration_percentage" name="concentration_percentage" value="{{ old('concentration_percentage', $product->concentration_percentage) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: 5.5%, 10%">
                </div>
            </div>
        </div>

        <!-- Instrucciones y Seguridad -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Instrucciones y Seguridad</h2>
            <div class="space-y-6">
                <div>
                    <label for="usage_instructions" class="block text-sm font-medium text-gray-700 mb-2">Instrucciones de Uso</label>
                    <textarea id="usage_instructions" name="usage_instructions" rows="3"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('usage_instructions', is_array($product->usage_instructions) ? implode(' ', $product->usage_instructions) : (string) $product->usage_instructions) }}</textarea>
                </div>

                <div>
                    <label for="precautions" class="block text-sm font-medium text-gray-700 mb-2">Precauciones</label>
                    <textarea id="precautions" name="precautions" rows="2"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('precautions', is_array($product->precautions) ? implode(' ', $product->precautions) : (string) $product->precautions) }}</textarea>
                </div>

                <div>
                    <label for="first_aid" class="block text-sm font-medium text-gray-700 mb-2">Primeros Auxilios</label>
                    <textarea id="first_aid" name="first_aid" rows="2"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('first_aid', is_array($product->first_aid) ? implode(' ', $product->first_aid) : (string) $product->first_aid) }}</textarea>
                </div>

                <div>
                    <label for="storage_conditions" class="block text-sm font-medium text-gray-700 mb-2">Condiciones de Almacenamiento</label>
                    <textarea id="storage_conditions" name="storage_conditions" rows="2"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('storage_conditions', is_array($product->storage_conditions) ? implode(' ', $product->storage_conditions) : (string) $product->storage_conditions) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Información Adicional</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                    <input type="text" id="color" name="color" value="{{ old('color', $product->color) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="fragrance" class="block text-sm font-medium text-gray-700 mb-2">Fragancia</label>
                    <input type="text" id="fragrance" name="fragrance" value="{{ old('fragrance', $product->fragrance) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="density" class="block text-sm font-medium text-gray-700 mb-2">Densidad (g/mL)</label>
                    <input type="number" id="density" name="density" value="{{ old('density', $product->density) }}"
                           step="0.001" min="0"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="shelf_life_months" class="block text-sm font-medium text-gray-700 mb-2">Vida Útil (meses)</label>
                    <input type="number" id="shelf_life_months" name="shelf_life_months" value="{{ old('shelf_life_months', $product->shelf_life_months) }}"
                           min="1" max="120"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="packaging_material" class="block text-sm font-medium text-gray-700 mb-2">Material del Envase</label>
                    <input type="text" id="packaging_material" name="packaging_material" value="{{ old('packaging_material', $product->packaging_material) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="certifications" class="block text-sm font-medium text-gray-700 mb-2">Certificaciones</label>
                    <input type="text" id="certifications" name="certifications" 
                           value="{{ old('certifications', is_array($product->certifications) ? implode(', ', $product->certifications) : '') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Separar con comas</p>
                </div>
            </div>
        </div>

        <!-- Nuevas Imágenes -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Imágenes del Producto</h2>
            
            @if(!empty($product->images))
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Imágenes Actuales</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($product->images as $index => $image)
                            <div class="relative group">
                                <img src="{{ Storage::url($image['path'] ?? '') }}" alt="Producto {{ $index + 1 }}" 
                                     class="w-full h-24 object-cover rounded-lg border border-gray-200">
                                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button type="button" onclick="removeImage({{ $index }})"
                                            class="bg-red-500 text-white rounded-full p-1 text-xs hover:bg-red-600">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <div>
                <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Agregar Nuevas Imágenes</label>
                <input type="file" id="images" name="images[]" multiple accept="image/*"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Máximo 10 imágenes nuevas. Formatos: JPG, PNG, GIF. Tamaño máximo: 2MB por imagen.</p>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="flex items-center justify-end space-x-4 pt-6">
            <a href="{{ route('admin.clean.products.show', $product) }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg transition duration-200">
                Cancelar
            </a>
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
                Actualizar Producto
            </button>
        </div>
    </form>
</div>

<script>
function removeImage(index) {
    if (confirm('¿Estás seguro de que quieres eliminar esta imagen?')) {
        // Aquí podrías implementar la eliminación via AJAX
        alert('Funcionalidad de eliminación de imágenes pendiente de implementar');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Validación de imágenes
    const imagesInput = document.getElementById('images');
    imagesInput.addEventListener('change', function() {
        const files = Array.from(this.files);
        const maxSize = 2 * 1024 * 1024; // 2MB
        const maxFiles = 10;
        
        if (files.length > maxFiles) {
            alert(`Máximo ${maxFiles} imágenes permitidas.`);
            this.value = '';
            return;
        }
        
        for (let file of files) {
            if (file.size > maxSize) {
                alert(`La imagen "${file.name}" excede el tamaño máximo de 2MB.`);
                this.value = '';
                return;
            }
        }
    });
});
</script>
@endsection