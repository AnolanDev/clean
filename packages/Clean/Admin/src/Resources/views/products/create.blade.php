@extends('clean-admin::layouts.admin')

@section('title', 'Crear Producto')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Crear Nuevo Producto</h1>
            <p class="text-gray-600 mt-2">Agrega un nuevo producto al catálogo Clean</p>
        </div>
        <div class="flex space-x-3">
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

    <form action="{{ route('admin.clean.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Información Básica -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Información Básica</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Producto *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: Desinfectante multiusos ecológico">
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
                            <option value="{{ $brand->id }}" {{ old('clean_brand_id') == $brand->id ? 'selected' : '' }}>
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
                            <option value="{{ $category->id }}" {{ old('clean_category_id') == $category->id ? 'selected' : '' }}>
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
                        <option value="liquid" {{ old('product_type') == 'liquid' ? 'selected' : '' }}>Líquido</option>
                        <option value="powder" {{ old('product_type') == 'powder' ? 'selected' : '' }}>Polvo</option>
                        <option value="gel" {{ old('product_type') == 'gel' ? 'selected' : '' }}>Gel</option>
                        <option value="spray" {{ old('product_type') == 'spray' ? 'selected' : '' }}>Spray</option>
                        <option value="foam" {{ old('product_type') == 'foam' ? 'selected' : '' }}>Espuma</option>
                        <option value="paste" {{ old('product_type') == 'paste' ? 'selected' : '' }}>Pasta</option>
                        <option value="crystal" {{ old('product_type') == 'crystal' ? 'selected' : '' }}>Cristal</option>
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
                        <option value="non_hazardous" {{ old('safety_classification') == 'non_hazardous' ? 'selected' : '' }}>No peligroso</option>
                        <option value="irritant" {{ old('safety_classification') == 'irritant' ? 'selected' : '' }}>Irritante</option>
                        <option value="corrosive" {{ old('safety_classification') == 'corrosive' ? 'selected' : '' }}>Corrosivo</option>
                        <option value="toxic" {{ old('safety_classification') == 'toxic' ? 'selected' : '' }}>Tóxico</option>
                        <option value="flammable" {{ old('safety_classification') == 'flammable' ? 'selected' : '' }}>Inflamable</option>
                    </select>
                    @error('safety_classification')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Descripción detallada del producto">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="benefits" class="block text-sm font-medium text-gray-700 mb-2">Beneficios</label>
                    <textarea id="benefits" name="benefits" rows="2"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Beneficios principales del producto">{{ old('benefits') }}</textarea>
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
                            <input type="checkbox" name="is_eco_friendly" value="1" {{ old('is_eco_friendly') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Ecológico</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_biodegradable" value="1" {{ old('is_biodegradable') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Biodegradable</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_concentrated" value="1" {{ old('is_concentrated') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Concentrado</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="food_contact_safe" value="1" {{ old('food_contact_safe') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Seguro para alimentos</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="no_residue" value="1" {{ old('no_residue') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Sin residuos</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="fabric_safe" value="1" {{ old('fabric_safe') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Seguro para textiles</span>
                        </label>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="font-medium text-gray-900">Propiedades Antimicrobianas</h3>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_antibacterial" value="1" {{ old('is_antibacterial') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Antibacterial</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_antiviral" value="1" {{ old('is_antiviral') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Antiviral</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_antifungal" value="1" {{ old('is_antifungal') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Antifúngico</span>
                        </label>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="font-medium text-gray-900">Composición</h3>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_phosphate_free" value="1" {{ old('is_phosphate_free') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Sin fosfatos</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_chlorine_free" value="1" {{ old('is_chlorine_free') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Sin cloro</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_ammonia_free" value="1" {{ old('is_ammonia_free') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Sin amoníaco</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_fragrance_free" value="1" {{ old('is_fragrance_free') ? 'checked' : '' }}
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
                    <input type="text" id="presentations" name="presentations" value="{{ old('presentations') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: 1L, 4L, 5L, 20L">
                    <p class="mt-1 text-sm text-gray-500">Separar con comas</p>
                </div>

                <div>
                    <label for="available_fragrances" class="block text-sm font-medium text-gray-700 mb-2">Aromas Disponibles</label>
                    <input type="text" id="available_fragrances" name="available_fragrances" value="{{ old('available_fragrances') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: Lavanda, Limón, Sin aroma">
                    <p class="mt-1 text-sm text-gray-500">Separar con comas</p>
                </div>

                <div>
                    <label for="usage_types" class="block text-sm font-medium text-gray-700 mb-2">Tipos de Uso</label>
                    <input type="text" id="usage_types" name="usage_types" value="{{ old('usage_types') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: Doméstico, Comercial, Industrial">
                    <p class="mt-1 text-sm text-gray-500">Separar con comas</p>
                </div>

                <div>
                    <label for="compatible_surfaces" class="block text-sm font-medium text-gray-700 mb-2">Superficies Compatibles</label>
                    <input type="text" id="compatible_surfaces" name="compatible_surfaces" value="{{ old('compatible_surfaces') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: Vidrio, Metal, Plástico">
                    <p class="mt-1 text-sm text-gray-500">Separar con comas</p>
                </div>

                <div>
                    <label for="ph_level" class="block text-sm font-medium text-gray-700 mb-2">Nivel de pH</label>
                    <select id="ph_level" name="ph_level"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleccionar nivel</option>
                        <option value="acidic" {{ old('ph_level') == 'acidic' ? 'selected' : '' }}>Ácido</option>
                        <option value="neutral" {{ old('ph_level') == 'neutral' ? 'selected' : '' }}>Neutro</option>
                        <option value="alkaline" {{ old('ph_level') == 'alkaline' ? 'selected' : '' }}>Alcalino</option>
                    </select>
                </div>

                <div>
                    <label for="ph_value" class="block text-sm font-medium text-gray-700 mb-2">Valor de pH</label>
                    <input type="number" id="ph_value" name="ph_value" value="{{ old('ph_value') }}"
                           min="0" max="14" step="0.1"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="7.0">
                </div>

                <div>
                    <label for="dilution_ratio" class="block text-sm font-medium text-gray-700 mb-2">Dilución</label>
                    <input type="text" id="dilution_ratio" name="dilution_ratio" value="{{ old('dilution_ratio') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: 1:10, 1:100">
                </div>

                <div>
                    <label for="concentration_percentage" class="block text-sm font-medium text-gray-700 mb-2">Concentración</label>
                    <input type="text" id="concentration_percentage" name="concentration_percentage" value="{{ old('concentration_percentage') }}"
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
                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Instrucciones detalladas de uso del producto">{{ old('usage_instructions') }}</textarea>
                </div>

                <div>
                    <label for="precautions" class="block text-sm font-medium text-gray-700 mb-2">Precauciones</label>
                    <textarea id="precautions" name="precautions" rows="2"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Precauciones de seguridad">{{ old('precautions') }}</textarea>
                </div>

                <div>
                    <label for="first_aid" class="block text-sm font-medium text-gray-700 mb-2">Primeros Auxilios</label>
                    <textarea id="first_aid" name="first_aid" rows="2"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Instrucciones de primeros auxilios">{{ old('first_aid') }}</textarea>
                </div>

                <div>
                    <label for="storage_conditions" class="block text-sm font-medium text-gray-700 mb-2">Condiciones de Almacenamiento</label>
                    <textarea id="storage_conditions" name="storage_conditions" rows="2"
                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Condiciones recomendadas de almacenamiento">{{ old('storage_conditions') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Información Adicional</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                    <input type="text" id="color" name="color" value="{{ old('color') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: Azul, Transparente">
                </div>

                <div>
                    <label for="fragrance" class="block text-sm font-medium text-gray-700 mb-2">Fragancia</label>
                    <input type="text" id="fragrance" name="fragrance" value="{{ old('fragrance') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: Lavanda, Cítrico">
                </div>

                <div>
                    <label for="density" class="block text-sm font-medium text-gray-700 mb-2">Densidad (g/mL)</label>
                    <input type="number" id="density" name="density" value="{{ old('density') }}"
                           step="0.001" min="0"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="1.000">
                </div>

                <div>
                    <label for="shelf_life_months" class="block text-sm font-medium text-gray-700 mb-2">Vida Útil (meses)</label>
                    <input type="number" id="shelf_life_months" name="shelf_life_months" value="{{ old('shelf_life_months') }}"
                           min="1" max="120"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="24">
                </div>

                <div>
                    <label for="packaging_material" class="block text-sm font-medium text-gray-700 mb-2">Material del Envase</label>
                    <input type="text" id="packaging_material" name="packaging_material" value="{{ old('packaging_material') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: HDPE, PET">
                </div>

                <div>
                    <label for="certifications" class="block text-sm font-medium text-gray-700 mb-2">Certificaciones</label>
                    <input type="text" id="certifications" name="certifications" value="{{ old('certifications') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: ISO 9001, INVIMA">
                    <p class="mt-1 text-sm text-gray-500">Separar con comas</p>
                </div>
            </div>
        </div>

        <!-- Imágenes -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Imágenes del Producto</h2>
            <div>
                <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Subir Imágenes</label>
                <input type="file" id="images" name="images[]" multiple accept="image/*"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Máximo 10 imágenes. Formatos: JPG, PNG, GIF. Tamaño máximo: 2MB por imagen.</p>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="flex items-center justify-end space-x-4 pt-6">
            <a href="{{ route('admin.clean.products.index') }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg transition duration-200">
                Cancelar
            </a>
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
                Crear Producto
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-sugerir nombre basado en marca y categoría
    const brandSelect = document.getElementById('clean_brand_id');
    const categorySelect = document.getElementById('clean_category_id');
    const nameInput = document.getElementById('name');
    
    function updateNameSuggestion() {
        const brandText = brandSelect.options[brandSelect.selectedIndex]?.text || '';
        const categoryText = categorySelect.options[categorySelect.selectedIndex]?.text || '';
        
        if (brandText && categoryText && !nameInput.value) {
            nameInput.placeholder = `${brandText} - ${categoryText}`;
        }
    }
    
    brandSelect.addEventListener('change', updateNameSuggestion);
    categorySelect.addEventListener('change', updateNameSuggestion);
    
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