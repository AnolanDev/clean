@extends('clean-admin::layouts.admin')

@section('title', 'Detalles del Cliente')

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
                                <a href="{{ route('admin.clean.clients.index') }}" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Clientes</span>
                                    👥
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-4 text-sm font-medium text-gray-500">{{ $cleanClient->company_name }}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="mt-2 text-2xl font-bold leading-6 text-gray-900 sm:text-3xl sm:truncate">
                        {{ $cleanClient->company_name }}
                    </h1>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a href="{{ route('admin.clean.clients.edit', $cleanClient) }}" 
                       class="inline-flex items-center justify-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                        </svg>
                        Editar Cliente
                    </a>
                </div>
            </div>
        </div>

        <!-- Información Principal -->
        <div class="mb-8 overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Información del Cliente</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalles completos del cliente y contacto.</p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Empresa</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $cleanClient->company_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Contacto Principal</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $cleanClient->contact_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <a href="mailto:{{ $cleanClient->contact_email }}" class="text-emerald-600 hover:text-emerald-500">
                                {{ $cleanClient->contact_email }}
                            </a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $cleanClient->contact_phone ?: 'No especificado' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Industria</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $cleanClient->getIndustryInfo()['icon'] }} {{ $cleanClient->getIndustryInfo()['label'] }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tipo de Cliente</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($cleanClient->client_type) }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nivel de Riesgo</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @php $riskInfo = $cleanClient->getRiskLevelInfo() @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                       @if($riskInfo['color'] === 'green') bg-green-100 text-green-800
                                       @elseif($riskInfo['color'] === 'yellow') bg-yellow-100 text-yellow-800
                                       @else bg-red-100 text-red-800 @endif">
                                {{ $riskInfo['label'] }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Estado</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if($cleanClient->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    ✅ Activo
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    ❌ Inactivo
                                </span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Información Financiera -->
        <div class="mb-8 overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Información Financiera</h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Límite de Crédito</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $cleanClient->getFormattedCreditLimit() }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Compras Totales</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $cleanClient->getFormattedTotalPurchases() }}
                            @if($cleanClient->isHighValue())
                                <span class="ml-1" title="Cliente de alto valor">⭐</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Términos de Pago</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $cleanClient->payment_terms ? $cleanClient->payment_terms . ' días' : 'No especificado' }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Información de Contacto -->
        @if($cleanClient->address || $cleanClient->website)
        <div class="mb-8 overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Información de Contacto</h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    @if($cleanClient->address)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Dirección</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $cleanClient->getFullAddress() }}</dd>
                    </div>
                    @endif
                    @if($cleanClient->website)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Sitio Web</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <a href="{{ $cleanClient->website }}" target="_blank" class="text-emerald-600 hover:text-emerald-500">
                                {{ $cleanClient->website }}
                            </a>
                        </dd>
                    </div>
                    @endif
                </dl>
            </div>
        </div>
        @endif

        <!-- Notas -->
        @if($cleanClient->notes)
        <div class="mb-8 overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Notas</h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <p class="text-sm text-gray-900">{{ $cleanClient->notes }}</p>
            </div>
        </div>
        @endif

        <!-- Alertas -->
        @if($cleanClient->needsAttention())
        <div class="mb-8 rounded-md bg-yellow-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Cliente Requiere Atención</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>Este cliente no ha realizado compras en los últimos 6 meses o nunca ha realizado una compra.</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Acciones -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.clean.clients.index') }}" 
               class="inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                ← Volver a Lista
            </a>
            <a href="{{ route('admin.clean.clients.edit', $cleanClient) }}" 
               class="inline-flex justify-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                Editar Cliente
            </a>
        </div>
    </div>
</div>
@endsection