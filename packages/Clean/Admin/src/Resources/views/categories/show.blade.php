@extends('clean-admin::layouts.admin')

@section('title', 'Detalles de la Categoría')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 sm:p-6 lg:p-8">
    <div class="mx-auto max-w-4xl">
        <!-- Header -->
        <div class="mb-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-4">
                            <li>
                                <a href="{{ route('admin.clean.categories.index') }}" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Categorías</span>
                                    🏷️
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-4 text-sm font-medium text-gray-500">{{ is_array($category->name) ? implode(' ', $category->name) : (string) $category->name }}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="mt-2 text-2xl font-bold leading-6 text-gray-900 sm:text-3xl sm:truncate">
                        {{ is_array($category->name) ? implode(' ', $category->name) : (string) $category->name }}
                    </h1>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a href="{{ route('admin.clean.categories.edit', $category) }}" 
                       class="inline-flex items-center justify-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                        </svg>
                        Editar Categoría
                    </a>
                </div>
            </div>
        </div>

        <!-- Información Principal -->
        <div class="mb-8 overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <div class="flex items-center">
                    @if($category->icon)
                        <div class="mr-4 flex-shrink-0">
                            <span class="text-2xl">{{ $category->icon }}</span>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Información de la Categoría</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalles completos de la categoría de productos.</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ is_array($category->name) ? implode(' ', $category->name) : (string) $category->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Slug</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $category->slug }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Orden</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $category->sort_order ?? 'Sin especificar' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Estado</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if($category->status)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    ✅ Activa
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    ❌ Inactiva
                                </span>
                            @endif
                        </dd>
                    </div>
                    @if($category->parent)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Categoría Padre</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <a href="{{ route('admin.clean.categories.show', $category->parent) }}" class="text-emerald-600 hover:text-emerald-500">
                                {{ is_array($category->parent->name) ? implode(' ', $category->parent->name) : (string) $category->parent->name }}
                            </a>
                        </dd>
                    </div>
                    @endif
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Área de Uso</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $category->usage_area ?? 'No especificada' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tipo de Superficie</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $category->surface_type ?? 'No especificado' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Requiere Dilución</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if($category->requires_dilution)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    ⚠️ Sí
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    ✅ No
                                </span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Uso Profesional</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if($category->professional_use)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    👔 Profesional
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    🏠 Doméstico
                                </span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Descripción -->
        @if($category->description)
        <div class="mb-8 overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Descripción</h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <p class="text-sm text-gray-900">{{ is_array($category->description) ? implode(' ', $category->description) : (string) $category->description }}</p>
            </div>
        </div>
        @endif

        <!-- Subcategorías -->
        @if($category->children && $category->children->count() > 0)
        <div class="mb-8 overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Subcategorías</h3>
                <p class="mt-1 text-sm text-gray-500">Categorías que dependen de esta categoría</p>
            </div>
            <div class="border-t border-gray-200">
                <ul class="divide-y divide-gray-200">
                    @foreach($category->children as $child)
                    <li class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                @if($child->icon)
                                    <span class="mr-3 text-xl">{{ $child->icon }}</span>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-gray-900">
                                        <a href="{{ route('admin.clean.categories.show', $child) }}" class="hover:text-emerald-600">
                                            {{ is_array($child->name) ? implode(' ', $child->name) : (string) $child->name }}
                                        </a>
                                    </p>
                                    @if($child->description)
                                        <p class="text-sm text-gray-500 mt-1">{{ Str::limit(is_array($child->description) ? implode(' ', $child->description) : (string) $child->description, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if($child->status)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Activa
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Inactiva
                                    </span>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <!-- Productos en esta categoría -->
        @if($category->products && $category->products->count() > 0)
        <div class="mb-8 overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Productos en esta Categoría</h3>
                <p class="mt-1 text-sm text-gray-500">{{ $category->products->count() }} productos asociados</p>
            </div>
            <div class="border-t border-gray-200">
                <ul class="divide-y divide-gray-200">
                    @foreach($category->products->take(10) as $product)
                    <li class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-sm mr-3">
                                    {{ strtoupper(substr(is_array($product->name) ? implode(' ', $product->name) : (string) $product->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">
                                        <a href="{{ route('admin.clean.products.show', $product) }}" class="hover:text-emerald-600">
                                            {{ is_array($product->name) ? implode(' ', $product->name) : (string) $product->name }}
                                        </a>
                                    </p>
                                    @if($product->brand)
                                        <p class="text-sm text-gray-500">{{ $product->brand->name }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if($product->status)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Inactivo
                                    </span>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @if($category->products->count() > 10)
                    <div class="px-4 py-3 bg-gray-50 text-center">
                        <p class="text-sm text-gray-500">
                            Y {{ $category->products->count() - 10 }} productos más...
                        </p>
                    </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Metadatos -->
        @if($category->metadata && !empty($category->metadata))
        <div class="mb-8 overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Metadatos</h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    @foreach($category->metadata as $key => $value)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">{{ ucfirst(str_replace('_', ' ', $key)) }}</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ is_array($value) ? implode(', ', $value) : $value }}</dd>
                    </div>
                    @endforeach
                </dl>
            </div>
        </div>
        @endif

        <!-- Acciones -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.clean.categories.index') }}" 
               class="inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                ← Volver a Lista
            </a>
            <a href="{{ route('admin.clean.categories.edit', $category) }}" 
               class="inline-flex justify-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                Editar Categoría
            </a>
        </div>
    </div>
</div>
@endsection