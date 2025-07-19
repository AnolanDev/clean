@extends('clean-admin::layouts.admin')

@section('title', 'Gestión de Clientes')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 sm:p-6 lg:p-8">
    <div class="mx-auto max-w-7xl">
        <!-- Header -->
        <div class="mb-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold leading-6 text-gray-900 sm:text-3xl sm:truncate">
                        👥 Gestión de Clientes
                    </h1>
                    <p class="mt-2 text-sm text-gray-700">
                        Administra tu cartera de clientes y sus relaciones comerciales
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a href="{{ route('admin.clean.clients.create') }}" 
                       class="inline-flex items-center justify-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                        </svg>
                        Nuevo Cliente
                    </a>
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="mb-8">
            <dl class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                    <dt>
                        <div class="absolute rounded-md bg-emerald-500 p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Total Clientes</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total']) }}</p>
                    </dd>
                </div>

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                    <dt>
                        <div class="absolute rounded-md bg-green-500 p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Clientes Activos</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['active']) }}</p>
                        <p class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                            {{ $stats['total'] > 0 ? round(($stats['active'] / $stats['total']) * 100, 1) : 0 }}%
                        </p>
                    </dd>
                </div>

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                    <dt>
                        <div class="absolute rounded-md bg-yellow-500 p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Alto Valor</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['high_value']) }}</p>
                    </dd>
                </div>

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                    <dt>
                        <div class="absolute rounded-md bg-red-500 p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Requieren Atención</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['needs_attention']) }}</p>
                    </dd>
                </div>
            </dl>
        </div>

        <!-- Filtros y Acciones -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 mb-6">
            <div class="px-4 py-4 border-b border-gray-200">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                    <!-- Título de la sección -->
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Filtros de Búsqueda</h3>
                    </div>

                    <!-- Acciones rápidas -->
                    <div class="flex items-center space-x-2">
                        <button onclick="toggleAdvancedFilters()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                            </svg>
                            Filtros Avanzados
                        </button>
                        <a href="{{ route('admin.clean.clients.export', request()->query()) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Exportar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Indicadores de filtros aplicados -->
            @php
                $hasFilters = collect($filters)->filter(fn($value) => !empty($value))->isNotEmpty();
            @endphp
            
            @if($hasFilters)
                <div class="px-4 py-3 bg-emerald-50 border-b border-emerald-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-6 h-6 bg-emerald-100 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-emerald-800">
                                {{ collect($filters)->filter(fn($value) => !empty($value))->count() }} filtro(s) aplicado(s)
                            </span>
                            @foreach($filters as $key => $value)
                                @if(!empty($value))
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        @if($key === 'search')
                                            🔍 {{ $value }}
                                        @elseif($key === 'industry_type')
                                            🏢 {{ ucfirst($value) }}
                                        @elseif($key === 'client_type')
                                            👥 {{ ucfirst($value) }}
                                        @elseif($key === 'risk_level')
                                            ⚠️ {{ ucfirst($value) }}
                                        @elseif($key === 'is_active')
                                            ✅ {{ $value == '1' ? 'Activos' : 'Inactivos' }}
                                        @else
                                            {{ $key }}: {{ $value }}
                                        @endif
                                    </span>
                                @endif
                            @endforeach
                        </div>
                        <a href="{{ route('admin.clean.clients.index') }}" 
                           class="text-sm font-medium text-emerald-600 hover:text-emerald-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Limpiar filtros
                        </a>
                    </div>
                </div>
            @endif
            
            <!-- Filtros principales -->
            <div class="px-4 py-4">
                <form id="filters-form" method="GET" action="{{ route('admin.clean.clients.index') }}" class="space-y-4">
                    <!-- Búsqueda principal -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="search" 
                                       id="search"
                                       value="{{ $filters['search'] ?? '' }}"
                                       placeholder="Buscar por empresa, contacto, email..."
                                       class="auto-filter block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm"
                                       data-delay="600">
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <select name="is_active" 
                                    class="auto-filter px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm">
                                <option value="">Todos los estados</option>
                                <option value="1" {{ ($filters['is_active'] ?? '') === '1' ? 'selected' : '' }}>✅ Activos</option>
                                <option value="0" {{ ($filters['is_active'] ?? '') === '0' ? 'selected' : '' }}>❌ Inactivos</option>
                            </select>
                        </div>
                    </div>

                    <!-- Filtros avanzados (colapsables) -->
                    <div id="advanced-filters" class="hidden">
                        <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                            <div class="flex items-center space-x-2 mb-3">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                </svg>
                                <h4 class="text-sm font-medium text-gray-700">Filtros Avanzados</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">

                                <!-- Industria -->
                                <div>
                                    <label for="industry_type" class="block text-xs font-medium text-gray-600 mb-1">Industria</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <select name="industry_type" id="industry_type" 
                                                class="auto-filter w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm">
                                            <option value="">Todas las industrias</option>
                                            <option value="hospitality" {{ ($filters['industry_type'] ?? '') === 'hospitality' ? 'selected' : '' }}>🏨 Hotelería</option>
                                            <option value="healthcare" {{ ($filters['industry_type'] ?? '') === 'healthcare' ? 'selected' : '' }}>🏥 Salud</option>
                                            <option value="education" {{ ($filters['industry_type'] ?? '') === 'education' ? 'selected' : '' }}>🏫 Educación</option>
                                            <option value="office" {{ ($filters['industry_type'] ?? '') === 'office' ? 'selected' : '' }}>🏢 Oficinas</option>
                                            <option value="retail" {{ ($filters['industry_type'] ?? '') === 'retail' ? 'selected' : '' }}>🏪 Retail</option>
                                            <option value="restaurant" {{ ($filters['industry_type'] ?? '') === 'restaurant' ? 'selected' : '' }}>🍽️ Restaurantes</option>
                                            <option value="manufacturing" {{ ($filters['industry_type'] ?? '') === 'manufacturing' ? 'selected' : '' }}>🏭 Manufactura</option>
                                            <option value="government" {{ ($filters['industry_type'] ?? '') === 'government' ? 'selected' : '' }}>🏛️ Gobierno</option>
                                            <option value="other" {{ ($filters['industry_type'] ?? '') === 'other' ? 'selected' : '' }}>🏢 Otro</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tipo de Cliente -->
                                <div>
                                    <label for="client_type" class="block text-xs font-medium text-gray-600 mb-1">Tipo de Cliente</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </div>
                                        <select name="client_type" id="client_type" 
                                                class="auto-filter w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm">
                                            <option value="">Todos los tipos</option>
                                            <option value="corporate" {{ ($filters['client_type'] ?? '') === 'corporate' ? 'selected' : '' }}>🏢 Corporativo</option>
                                            <option value="small_business" {{ ($filters['client_type'] ?? '') === 'small_business' ? 'selected' : '' }}>🏪 Pequeña Empresa</option>
                                            <option value="government" {{ ($filters['client_type'] ?? '') === 'government' ? 'selected' : '' }}>🏛️ Gobierno</option>
                                            <option value="institution" {{ ($filters['client_type'] ?? '') === 'institution' ? 'selected' : '' }}>🏫 Institución</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Nivel de Riesgo -->
                                <div>
                                    <label for="risk_level" class="block text-xs font-medium text-gray-600 mb-1">Nivel de Riesgo</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                                            </svg>
                                        </div>
                                        <select name="risk_level" id="risk_level" 
                                                class="auto-filter w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm">
                                            <option value="">Todos los niveles</option>
                                            <option value="low" {{ ($filters['risk_level'] ?? '') === 'low' ? 'selected' : '' }}>🟢 Bajo</option>
                                            <option value="medium" {{ ($filters['risk_level'] ?? '') === 'medium' ? 'selected' : '' }}>🟡 Medio</option>
                                            <option value="high" {{ ($filters['risk_level'] ?? '') === 'high' ? 'selected' : '' }}>🔴 Alto</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Ordenar por -->
                                <div>
                                    <label for="sort_by" class="block text-xs font-medium text-gray-600 mb-1">Ordenar por</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                            </svg>
                                        </div>
                                        <select name="sort_by" id="sort_by" 
                                                class="auto-filter w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm">
                                            <option value="company_name" {{ ($filters['sort_by'] ?? 'company_name') === 'company_name' ? 'selected' : '' }}>📊 Empresa</option>
                                            <option value="contact_name" {{ ($filters['sort_by'] ?? '') === 'contact_name' ? 'selected' : '' }}>👤 Contacto</option>
                                            <option value="total_purchases" {{ ($filters['sort_by'] ?? '') === 'total_purchases' ? 'selected' : '' }}>💰 Compras</option>
                                            <option value="created_at" {{ ($filters['sort_by'] ?? '') === 'created_at' ? 'selected' : '' }}>📅 Fecha registro</option>
                                            <option value="last_purchase_date" {{ ($filters['sort_by'] ?? '') === 'last_purchase_date' ? 'selected' : '' }}>🛒 Última compra</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Orden -->
                                <div>
                                    <label for="sort_order" class="block text-xs font-medium text-gray-600 mb-1">Orden</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                                            </svg>
                                        </div>
                                        <select name="sort_order" id="sort_order" 
                                                class="auto-filter w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm">
                                            <option value="asc" {{ ($filters['sort_order'] ?? 'asc') === 'asc' ? 'selected' : '' }}>⬆️ Ascendente</option>
                                            <option value="desc" {{ ($filters['sort_order'] ?? '') === 'desc' ? 'selected' : '' }}>⬇️ Descendente</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Acciones Masivas -->
        <div class="mb-4" x-data="{ selectedClients: [], showBulkActions: false }" 
             x-init="$watch('selectedClients', value => showBulkActions = value.length > 0)">
            
            <div x-show="showBulkActions" x-cloak
                 class="rounded-lg bg-blue-50 p-4 mb-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-blue-900" x-text="`${selectedClients.length} cliente(s) seleccionado(s)`"></span>
                    </div>
                    <div class="flex space-x-2">
                        <form method="POST" action="{{ route('admin.clean.clients.bulk-action') }}" class="inline">
                            @csrf
                            <input type="hidden" name="action" value="activate">
                            <template x-for="clientId in selectedClients">
                                <input type="hidden" name="client_ids[]" :value="clientId">
                            </template>
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-green-700 bg-green-100 hover:bg-green-200">
                                ✅ Activar
                            </button>
                        </form>
                        
                        <form method="POST" action="{{ route('admin.clean.clients.bulk-action') }}" class="inline">
                            @csrf
                            <input type="hidden" name="action" value="deactivate">
                            <template x-for="clientId in selectedClients">
                                <input type="hidden" name="client_ids[]" :value="clientId">
                            </template>
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-yellow-700 bg-yellow-100 hover:bg-yellow-200">
                                ⏸️ Desactivar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Lista de Clientes -->
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="relative px-6 py-3">
                                <input type="checkbox" 
                                       class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-600"
                                       @change="selectedClients = $event.target.checked ? @json($clients->pluck('id')) : []">
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                Cliente
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                Industria
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                Riesgo
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                Compras
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                Estado
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($clients as $client)
                        <tr class="hover:bg-gray-50">
                            <td class="relative px-6 py-4">
                                <input type="checkbox" 
                                       class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-600"
                                       value="{{ $client->id }}"
                                       x-model="selectedClients">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">{{ $client->company_name }}</div>
                                        <div class="text-gray-500">{{ $client->contact_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $client->contact_email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $client->getIndustryInfo()['icon'] }} {{ $client->getIndustryInfo()['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php $riskInfo = $client->getRiskLevelInfo() @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                           @if($riskInfo['color'] === 'green') bg-green-100 text-green-800
                                           @elseif($riskInfo['color'] === 'yellow') bg-yellow-100 text-yellow-800
                                           @else bg-red-100 text-red-800 @endif">
                                    {{ $riskInfo['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $client->getFormattedTotalPurchases() }}
                                @if($client->isHighValue())
                                    <span class="ml-1">⭐</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($client->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        ✅ Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        ❌ Inactivo
                                    </span>
                                @endif
                                @if($client->needsAttention())
                                    <span class="ml-1" title="Requiere atención">⚠️</span>
                                @endif
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.clean.clients.show', $client) }}" 
                                       class="text-emerald-600 hover:text-emerald-900">Ver</a>
                                    <a href="{{ route('admin.clean.clients.edit', $client) }}" 
                                       class="text-blue-600 hover:text-blue-900">Editar</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No hay clientes</h3>
                                    <p class="mt-1 text-sm text-gray-500">Comienza creando tu primer cliente.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('admin.clean.clients.create') }}" 
                                           class="inline-flex items-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500">
                                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                            </svg>
                                            Nuevo Cliente
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($clients->hasPages())
            <div class="mt-6">
                {{ $clients->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Configuración para filtros automáticos
    let filterTimeout;
    const AUTO_FILTER_DELAY = 600; // 600ms de debounce para búsqueda de clientes
    
    // Inicializar filtros automáticos
    document.addEventListener('DOMContentLoaded', function() {
        initAutoFilters();
        restoreFocus();
    });
    
    // Restaurar foco después de la recarga de página
    function restoreFocus() {
        const focusedElementId = sessionStorage.getItem('focusedElement');
        const cursorPosition = sessionStorage.getItem('cursorPosition');
        
        if (focusedElementId) {
            const element = document.getElementById(focusedElementId) || document.querySelector(`[name="${focusedElementId}"]`);
            if (element) {
                // Pequeño delay para asegurar que el DOM esté completamente cargado
                setTimeout(() => {
                    element.focus();
                    if (cursorPosition && (element.type === 'text' || element.type === 'search')) {
                        element.setSelectionRange(cursorPosition, cursorPosition);
                    }
                }, 100);
            }
            
            // Limpiar sessionStorage
            sessionStorage.removeItem('focusedElement');
            sessionStorage.removeItem('cursorPosition');
        }
    }
    
    function initAutoFilters() {
        const form = document.getElementById('filters-form');
        const autoFilterElements = document.querySelectorAll('.auto-filter');
        
        autoFilterElements.forEach(element => {
            if (element.type === 'text' || element.type === 'search') {
                // Para campos de texto, usar debounce
                element.addEventListener('input', function() {
                    clearTimeout(filterTimeout);
                    const delay = parseInt(element.getAttribute('data-delay')) || AUTO_FILTER_DELAY;
                    
                    filterTimeout = setTimeout(() => {
                        submitFilters();
                    }, delay);
                });
            } else {
                // Para selects, aplicar filtro inmediatamente
                element.addEventListener('change', function() {
                    clearTimeout(filterTimeout);
                    submitFilters();
                });
            }
        });
    }
    
    function submitFilters() {
        const form = document.getElementById('filters-form');
        if (form) {
            // Guardar información del elemento activo
            const activeElement = document.activeElement;
            if (activeElement && (activeElement.type === 'text' || activeElement.type === 'search')) {
                const elementId = activeElement.id || activeElement.name;
                const cursorPosition = activeElement.selectionStart;
                
                // Guardar en sessionStorage para restaurar después de la recarga
                sessionStorage.setItem('focusedElement', elementId);
                sessionStorage.setItem('cursorPosition', cursorPosition);
            }
            
            // Mostrar indicador de carga
            showLoadingIndicator();
            form.submit();
        }
    }
    
    function showLoadingIndicator() {
        // Ya no necesitamos mostrar indicador de carga ya que los filtros son automáticos
        // Esta función se mantiene para compatibilidad pero no hace nada
    }
    
    // Toggle para filtros avanzados
    function toggleAdvancedFilters() {
        const advancedFilters = document.getElementById('advanced-filters');
        const button = event.target;
        
        if (advancedFilters.classList.contains('hidden')) {
            advancedFilters.classList.remove('hidden');
            button.innerHTML = `
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
                Ocultar Filtros
            `;
            button.classList.remove('bg-gray-100', 'hover:bg-gray-200', 'text-gray-700');
            button.classList.add('bg-emerald-100', 'hover:bg-emerald-200', 'text-emerald-700');
        } else {
            advancedFilters.classList.add('hidden');
            button.innerHTML = `
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                </svg>
                Filtros Avanzados
            `;
            button.classList.remove('bg-emerald-100', 'hover:bg-emerald-200', 'text-emerald-700');
            button.classList.add('bg-gray-100', 'hover:bg-gray-200', 'text-gray-700');
        }
    }
</script>
@endpush
@endsection