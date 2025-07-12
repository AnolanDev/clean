@extends('clean-admin::layouts.admin')

@section('title', 'Editar Marca: ' . $brand->name)

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Compacto -->
    <div class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.clean.brands.show', $brand) }}" class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center justify-center transition-colors duration-200">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div class="w-10 h-10 bg-amber-500 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Editar Marca</h1>
                    <p class="text-sm text-gray-500">{{ $brand->name }} • Modificar información de la marca</p>
                </div>
            </div>
            <div class="text-right">
                <span class="text-xs text-gray-500">Formulario de Edición</span>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="px-4 py-6">
        <div class="max-w-4xl mx-auto">
            <form action="{{ route('admin.clean.brands.update', $brand) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Información Básica -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Información Básica</h2>
                                <p class="text-sm text-gray-500">Datos principales de la marca</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Nombre -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nombre de la Marca *
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $brand->name) }}"
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-300 @enderror"
                                       placeholder="Ej: EcoClean Solutions"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                    Slug (URL amigable)
                                </label>
                                <input type="text" 
                                       id="slug" 
                                       name="slug" 
                                       value="{{ old('slug', $brand->slug) }}"
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-300 @enderror"
                                       placeholder="Se genera automáticamente">
                                @error('slug')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Si no se especifica, se generará automáticamente desde el nombre</p>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Descripción
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="4"
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-300 @enderror"
                                      placeholder="Descripción de la marca, valores, historia, etc.">{{ old('description', $brand->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- País y Sitio Web -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                                    País de Origen
                                </label>
                                <input type="text" 
                                       id="country" 
                                       name="country" 
                                       value="{{ old('country', $brand->country) }}"
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('country') border-red-300 @enderror"
                                       placeholder="Ej: España, México, Estados Unidos">
                                @error('country')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="website" class="block text-sm font-medium text-gray-700 mb-2">
                                    Sitio Web
                                </label>
                                <input type="url" 
                                       id="website" 
                                       name="website" 
                                       value="{{ old('website', $brand->website) }}"
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('website') border-red-300 @enderror"
                                       placeholder="https://www.ejemplo.com">
                                @error('website')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Logo -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Logo de la Marca</h2>
                                <p class="text-sm text-gray-500">Imagen representativa de la marca</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        @if($brand->logo)
                            <!-- Logo Actual -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Logo Actual</label>
                                <div class="flex items-center space-x-4">
                                    <img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}" class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-600">{{ basename($brand->logo) }}</p>
                                        <p class="text-xs text-gray-500">Subir una nueva imagen para reemplazarla</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Subir Nuevo Logo -->
                        <div class="flex items-center justify-center w-full">
                            <label for="logo" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500">
                                        <span class="font-semibold">Click para {{ $brand->logo ? 'cambiar' : 'subir' }}</span> 
                                        {{ $brand->logo ? 'logo' : 'o arrastra y suelta' }}
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF, SVG (MAX. 2MB)</p>
                                </div>
                                <input id="logo" name="logo" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        @error('logo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Características -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Características</h2>
                                <p class="text-sm text-gray-500">Propiedades especiales de la marca</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Ecológica -->
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="is_eco_friendly" 
                                   name="is_eco_friendly" 
                                   value="1"
                                   {{ old('is_eco_friendly', $brand->is_eco_friendly) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                            <label for="is_eco_friendly" class="ml-3 flex items-center">
                                <span class="text-sm font-medium text-gray-700">Marca Ecológica</span>
                                <div class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    Eco
                                </div>
                            </label>
                        </div>
                        <p class="text-sm text-gray-500 ml-6">Marca que fabrica productos amigables con el medio ambiente</p>

                        <!-- Certificaciones -->
                        <div>
                            <label for="certifications" class="block text-sm font-medium text-gray-700 mb-2">
                                Certificaciones
                            </label>
                            <input type="text" 
                                   id="certifications" 
                                   name="certifications" 
                                   value="{{ old('certifications', is_array($brand->certifications) ? implode(', ', $brand->certifications) : '') }}"
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('certifications') border-red-300 @enderror"
                                   placeholder="ISO 14001, ECOCERT, Cradle to Cradle, etc.">
                            @error('certifications')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Separar múltiples certificaciones con comas</p>
                        </div>
                    </div>
                </div>

                <!-- Configuración -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Configuración</h2>
                                <p class="text-sm text-gray-500">Estado y orden de visualización</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Estado -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                                <div class="flex items-center space-x-4">
                                    <label class="flex items-center">
                                        <input type="radio" 
                                               name="status" 
                                               value="1" 
                                               {{ old('status', $brand->status) == '1' ? 'checked' : '' }}
                                               class="text-green-600 focus:ring-green-500">
                                        <span class="ml-2 text-sm text-gray-700 flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Activa
                                        </span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" 
                                               name="status" 
                                               value="0" 
                                               {{ old('status', $brand->status) == '0' ? 'checked' : '' }}
                                               class="text-red-600 focus:ring-red-500">
                                        <span class="ml-2 text-sm text-gray-700 flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Inactiva
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!-- Orden -->
                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                    Orden de Visualización
                                </label>
                                <input type="number" 
                                       id="sort_order" 
                                       name="sort_order" 
                                       value="{{ old('sort_order', $brand->sort_order) }}"
                                       min="0"
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('sort_order') border-red-300 @enderror"
                                       placeholder="0">
                                @error('sort_order')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Menor número = mayor prioridad</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="bg-blue-50 rounded-lg border border-blue-200 p-4">
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center mr-3 mt-0.5">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-medium text-blue-900 mb-1">Información de la Marca</h3>
                            <div class="text-sm text-blue-700 space-y-1">
                                <p><strong>Creada:</strong> {{ $brand->created_at->format('d/m/Y H:i') }}</p>
                                <p><strong>Última actualización:</strong> {{ $brand->updated_at->format('d/m/Y H:i') }}</p>
                                @if($brand->products_count)
                                    <p><strong>Productos asociados:</strong> {{ $brand->products_count }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6">
                    <a href="{{ route('admin.clean.brands.show', $brand) }}" 
                       class="w-full sm:w-auto px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-medium transition-colors duration-200 text-center">
                        Cancelar
                    </a>
                    
                    <div class="flex items-center space-x-3">
                        <button type="submit" 
                                name="action" 
                                value="save_and_continue"
                                class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-sm font-medium transition-colors duration-200">
                            Guardar y Continuar Editando
                        </button>
                        <button type="submit" 
                                name="action" 
                                value="save"
                                class="px-6 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg text-sm font-medium transition-colors duration-200">
                            Actualizar Marca
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Auto-generar slug desde el nombre (solo si no se ha editado manualmente)
let originalSlug = '{{ $brand->slug }}';
let manualSlugEdit = false;

document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const slugField = document.getElementById('slug');
    
    if (!manualSlugEdit) {
        const slug = name
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        
        slugField.value = slug;
    }
});

// Marcar slug como manual si el usuario lo edita
document.getElementById('slug').addEventListener('input', function() {
    if (this.value !== originalSlug) {
        manualSlugEdit = true;
    }
});

// Preview de imagen
document.getElementById('logo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Crear preview
            const label = document.querySelector('label[for="logo"]');
            label.innerHTML = `
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <img src="${e.target.result}" alt="Preview" class="w-20 h-20 object-cover rounded-lg mb-4">
                    <p class="text-sm text-gray-500"><span class="font-semibold">Nuevo logo seleccionado</span></p>
                    <p class="text-xs text-gray-500">${file.name}</p>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }
});

// Validación en tiempo real
document.querySelectorAll('input[required]').forEach(input => {
    input.addEventListener('blur', function() {
        if (!this.value.trim()) {
            this.classList.add('border-red-300');
        } else {
            this.classList.remove('border-red-300');
        }
    });
});

// Validación de URL
document.getElementById('website').addEventListener('blur', function() {
    if (this.value && !this.value.match(/^https?:\/\/.+/)) {
        this.value = 'https://' + this.value;
    }
});

// Confirmación antes de salir si hay cambios
let formChanged = false;
document.querySelectorAll('input, textarea, select').forEach(element => {
    element.addEventListener('change', function() {
        formChanged = true;
    });
});

window.addEventListener('beforeunload', function(e) {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// No mostrar confirmación al enviar el formulario
document.querySelector('form').addEventListener('submit', function() {
    formChanged = false;
});
</script>
@endpush