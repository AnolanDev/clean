@extends('clean-admin::layouts.admin')

@section('title', 'Editar Ingrediente')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">🧪 Editar Ingrediente</h1>
                    <p class="mt-1 text-sm text-gray-500">Modifica la información del ingrediente: {{ $ingredient->name }}</p>
                </div>
                <div class="mt-4 sm:mt-0 flex gap-2">
                    <a href="{{ route('admin.clean.ingredients.show', $ingredient) }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Ver
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

    <!-- Formulario -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <form method="POST" action="{{ route('admin.clean.ingredients.update', $ingredient) }}" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="px-4 py-5 sm:p-6">
                <!-- Información básica -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="lg:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">📋 Información Básica</h3>
                    </div>
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nombre del Ingrediente <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $ingredient->name) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('name') border-red-500 @enderror"
                               placeholder="Ej: Sodium Lauryl Sulfate"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="chemical_name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nombre Químico
                        </label>
                        <input type="text" 
                               id="chemical_name" 
                               name="chemical_name" 
                               value="{{ old('chemical_name', $ingredient->chemical_name) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('chemical_name') border-red-500 @enderror"
                               placeholder="Ej: Dodecyl sodium sulfate">
                        @error('chemical_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="cas_number" class="block text-sm font-medium text-gray-700 mb-1">
                            Número CAS
                        </label>
                        <input type="text" 
                               id="cas_number" 
                               name="cas_number" 
                               value="{{ old('cas_number', $ingredient->cas_number) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('cas_number') border-red-500 @enderror"
                               placeholder="Ej: 151-21-3">
                        @error('cas_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                            Tipo/Función <span class="text-red-500">*</span>
                        </label>
                        <select id="type" 
                                name="type" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('type') border-red-500 @enderror"
                                required>
                            <option value="">Seleccionar tipo</option>
                            @foreach($ingredientTypes as $type)
                                <option value="{{ $type }}" {{ old('type', $ingredient->type) === $type ? 'selected' : '' }}>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="lg:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Descripción
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror"
                                  placeholder="Describe la función y características del ingrediente...">{{ old('description', $ingredient->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Seguridad -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
                    <div class="lg:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">⚠️ Información de Seguridad</h3>
                    </div>

                    <div>
                        <label for="safety_level" class="block text-sm font-medium text-gray-700 mb-1">
                            Nivel de Seguridad <span class="text-red-500">*</span>
                        </label>
                        <select id="safety_level" 
                                name="safety_level" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('safety_level') border-red-500 @enderror"
                                required>
                            <option value="">Seleccionar nivel</option>
                            @foreach($safetyLevels as $level)
                                <option value="{{ $level }}" {{ old('safety_level', $ingredient->safety_level) === $level ? 'selected' : '' }}>
                                    {{ ucfirst($level) }}
                                </option>
                            @endforeach
                        </select>
                        @error('safety_level')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Símbolos de Peligro
                        </label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($hazardSymbols as $symbol)
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           name="hazard_symbols[]" 
                                           value="{{ $symbol }}"
                                           {{ in_array($symbol, old('hazard_symbols', $ingredient->hazard_symbols ?? [])) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-gray-700">{{ ucfirst($symbol) }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('hazard_symbols')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="lg:col-span-2">
                        <label for="safety_instructions" class="block text-sm font-medium text-gray-700 mb-1">
                            Instrucciones de Seguridad
                        </label>
                        <textarea id="safety_instructions" 
                                  name="safety_instructions" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('safety_instructions') border-red-500 @enderror"
                                  placeholder="Instrucciones específicas de manejo y seguridad...">{{ old('safety_instructions', $ingredient->safety_instructions) }}</textarea>
                        @error('safety_instructions')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Propiedades -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
                    <div class="lg:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">🌿 Propiedades</h3>
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   name="is_natural" 
                                   value="1"
                                   {{ old('is_natural', $ingredient->is_natural) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm font-medium text-gray-700">🌿 Ingrediente Natural</span>
                        </label>
                        <p class="mt-1 text-xs text-gray-500">Marca si el ingrediente es de origen natural</p>
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   name="is_biodegradable" 
                                   value="1"
                                   {{ old('is_biodegradable', $ingredient->is_biodegradable) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm font-medium text-gray-700">♻️ Biodegradable</span>
                        </label>
                        <p class="mt-1 text-xs text-gray-500">Marca si el ingrediente es biodegradable</p>
                    </div>
                </div>

                <!-- Concentración -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
                    <div class="lg:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">📊 Concentración</h3>
                    </div>

                    <div>
                        <label for="concentration_min" class="block text-sm font-medium text-gray-700 mb-1">
                            Concentración Mínima (%)
                        </label>
                        <input type="number" 
                               id="concentration_min" 
                               name="concentration_min" 
                               value="{{ old('concentration_min', $ingredient->concentration_min) }}"
                               step="0.01"
                               min="0"
                               max="100"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('concentration_min') border-red-500 @enderror"
                               placeholder="0.00">
                        @error('concentration_min')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="concentration_max" class="block text-sm font-medium text-gray-700 mb-1">
                            Concentración Máxima (%)
                        </label>
                        <input type="number" 
                               id="concentration_max" 
                               name="concentration_max" 
                               value="{{ old('concentration_max', $ingredient->concentration_max) }}"
                               step="0.01"
                               min="0"
                               max="100"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('concentration_max') border-red-500 @enderror"
                               placeholder="100.00">
                        @error('concentration_max')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">ℹ️ Información Adicional</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-medium text-gray-700">Creado:</span>
                                <span class="text-gray-600">{{ $ingredient->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Actualizado:</span>
                                <span class="text-gray-600">{{ $ingredient->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 sm:px-6">
                <div class="flex flex-col sm:flex-row sm:justify-end gap-3">
                    <a href="{{ route('admin.clean.ingredients.show', $ingredient) }}" 
                       class="w-full sm:w-auto bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 text-center">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Actualizar Ingrediente
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Validación en tiempo real de concentraciones
    document.getElementById('concentration_min').addEventListener('input', function() {
        const min = parseFloat(this.value);
        const maxInput = document.getElementById('concentration_max');
        const max = parseFloat(maxInput.value);
        
        if (min && max && min > max) {
            maxInput.value = min;
        }
    });

    document.getElementById('concentration_max').addEventListener('input', function() {
        const max = parseFloat(this.value);
        const minInput = document.getElementById('concentration_min');
        const min = parseFloat(minInput.value);
        
        if (min && max && max < min) {
            minInput.value = max;
        }
    });
</script>
@endpush
@endsection