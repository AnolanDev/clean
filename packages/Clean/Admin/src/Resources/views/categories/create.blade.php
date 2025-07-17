@extends('clean-admin::layouts.admin')

@section('title', 'Nueva Categoría Clean')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Compacto -->
    <div class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.clean.categories.index') }}" class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center justify-center transition-colors duration-200">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div class="w-10 h-10 bg-emerald-500 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Nueva Categoría</h1>
                    <p class="text-sm text-gray-500">Crear una nueva categoría para el catálogo Clean</p>
                </div>
            </div>
            <div class="text-right">
                <span class="text-xs text-gray-500">Formulario de Creación</span>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="px-4 py-6">
        <div class="max-w-4xl mx-auto">
            <form action="{{ route('admin.clean.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

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
                                <p class="text-sm text-gray-500">Datos principales de la categoría</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Nombre y Slug -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nombre de la Categoría *
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('name') border-red-300 @enderror"
                                       placeholder="Ej: Limpiadores de Baño"
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
                                       value="{{ old('slug') }}"
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('slug') border-red-300 @enderror"
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
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('description') border-red-300 @enderror"
                                      placeholder="Descripción de la categoría, productos que incluye, etc.">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Categoría Padre y Icono -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Categoría Padre
                                </label>
                                <select id="parent_id" 
                                        name="parent_id" 
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('parent_id') border-red-300 @enderror">
                                    <option value="">Categoría Principal</option>
                                    @foreach($parentCategories as $parent)
                                        <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                            {{ $parent->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Deja vacío para categoría principal</p>
                            </div>

                            <div>
                                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                                    Icono (Emoji)
                                </label>
                                <input type="text" 
                                       id="icon" 
                                       name="icon" 
                                       value="{{ old('icon') }}"
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('icon') border-red-300 @enderror"
                                       placeholder="🧽">
                                @error('icon')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Usa un emoji para representar la categoría</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Especificaciones de Uso -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Especificaciones de Uso</h2>
                                <p class="text-sm text-gray-500">Características específicas de la categoría</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Área de Uso -->
                            <div>
                                <label for="usage_area" class="block text-sm font-medium text-gray-700 mb-2">
                                    Área de Uso
                                </label>
                                <input type="text" 
                                       id="usage_area" 
                                       name="usage_area" 
                                       value="{{ old('usage_area') }}"
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('usage_area') border-red-300 @enderror"
                                       placeholder="Ej: Baño, Cocina, Oficina">
                                @error('usage_area')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tipo de Superficie -->
                            <div>
                                <label for="surface_type" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tipo de Superficie
                                </label>
                                <input type="text" 
                                       id="surface_type" 
                                       name="surface_type" 
                                       value="{{ old('surface_type') }}"
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('surface_type') border-red-300 @enderror"
                                       placeholder="Ej: Cerámica, Vidrio, Metal">
                                @error('surface_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Características booleanas -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Requiere Dilución -->
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       id="requires_dilution" 
                                       name="requires_dilution" 
                                       value="1"
                                       {{ old('requires_dilution') ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                <label for="requires_dilution" class="ml-3 flex items-center">
                                    <span class="text-sm font-medium text-gray-700">Requiere Dilución</span>
                                    <div class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Diluible
                                    </div>
                                </label>
                            </div>

                            <!-- Uso Profesional -->
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       id="professional_use" 
                                       name="professional_use" 
                                       value="1"
                                       {{ old('professional_use') ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                <label for="professional_use" class="ml-3 flex items-center">
                                    <span class="text-sm font-medium text-gray-700">Uso Profesional</span>
                                    <div class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 112 2v6a2 2 0 11-2 2H8a2 2 0 11-2-2V8a2 2 0 112-2z"></path>
                                        </svg>
                                        Pro
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Imagen de la Categoría -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Imagen de la Categoría</h2>
                                <p class="text-sm text-gray-500">Imagen representativa de la categoría</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center justify-center w-full">
                            <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click para subir</span> o arrastra y suelta</p>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF (MAX. 2MB)</p>
                                </div>
                                <input id="image" name="image" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
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
                                               {{ old('status', '1') == '1' ? 'checked' : '' }}
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
                                               {{ old('status') == '0' ? 'checked' : '' }}
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
                                       value="{{ old('sort_order', 0) }}"
                                       min="0"
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('sort_order') border-red-300 @enderror"
                                       placeholder="0">
                                @error('sort_order')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Menor número = mayor prioridad</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6">
                    <a href="{{ route('admin.clean.categories.index') }}" 
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
                            Crear Categoría
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
// Auto-generar slug desde el nombre
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const slugField = document.getElementById('slug');
    
    if (!slugField.value || slugField.dataset.autoGenerated !== 'false') {
        const slug = name
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        
        slugField.value = slug;
        slugField.dataset.autoGenerated = 'true';
    }
});

// Marcar slug como manual si el usuario lo edita
document.getElementById('slug').addEventListener('input', function() {
    this.dataset.autoGenerated = 'false';
});

// Preview de imagen
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Crear preview
            const label = document.querySelector('label[for="image"]');
            label.innerHTML = `
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <img src="${e.target.result}" alt="Preview" class="w-20 h-20 object-cover rounded-lg mb-4">
                    <p class="text-sm text-gray-500"><span class="font-semibold">Click para cambiar</span></p>
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
</script>
@endpush