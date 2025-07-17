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

        <!-- Filtros y Búsqueda -->
        <div class="mb-6 rounded-lg bg-white p-6 shadow">
            <form method="GET" action="{{ route('admin.clean.clients.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
                    <!-- Búsqueda -->
                    <div class="lg:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700">Buscar</label>
                        <input type="text" 
                               name="search" 
                               id="search"
                               value="{{ $filters['search'] ?? '' }}"
                               placeholder="Empresa, contacto, email..."
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                    </div>

                    <!-- Industria -->
                    <div>
                        <label for="industry_type" class="block text-sm font-medium text-gray-700">Industria</label>
                        <select name="industry_type" id="industry_type" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                            <option value="">Todas</option>
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

                    <!-- Tipo de Cliente -->
                    <div>
                        <label for="client_type" class="block text-sm font-medium text-gray-700">Tipo</label>
                        <select name="client_type" id="client_type" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                            <option value="">Todos</option>
                            <option value="corporate" {{ ($filters['client_type'] ?? '') === 'corporate' ? 'selected' : '' }}>Corporativo</option>
                            <option value="small_business" {{ ($filters['client_type'] ?? '') === 'small_business' ? 'selected' : '' }}>Pequeña Empresa</option>
                            <option value="government" {{ ($filters['client_type'] ?? '') === 'government' ? 'selected' : '' }}>Gobierno</option>
                            <option value="institution" {{ ($filters['client_type'] ?? '') === 'institution' ? 'selected' : '' }}>Institución</option>
                        </select>
                    </div>

                    <!-- Nivel de Riesgo -->
                    <div>
                        <label for="risk_level" class="block text-sm font-medium text-gray-700">Riesgo</label>
                        <select name="risk_level" id="risk_level" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                            <option value="">Todos</option>
                            <option value="low" {{ ($filters['risk_level'] ?? '') === 'low' ? 'selected' : '' }}>Bajo</option>
                            <option value="medium" {{ ($filters['risk_level'] ?? '') === 'medium' ? 'selected' : '' }}>Medio</option>
                            <option value="high" {{ ($filters['risk_level'] ?? '') === 'high' ? 'selected' : '' }}>Alto</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-3">
                    <button type="submit" 
                            class="inline-flex justify-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                        🔍 Filtrar
                    </button>
                    <a href="{{ route('admin.clean.clients.index') }}" 
                       class="inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        🗑️ Limpiar
                    </a>
                    <a href="{{ route('admin.clean.clients.export', request()->query()) }}" 
                       class="inline-flex justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                        📄 Exportar CSV
                    </a>
                </div>
            </form>
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
                {{ $clients->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection