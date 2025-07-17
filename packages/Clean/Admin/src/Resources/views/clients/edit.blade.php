@extends('clean-admin::layouts.admin')

@section('title', 'Editar Cliente')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 sm:p-6 lg:p-8">
    <div class="mx-auto max-w-4xl">
        <!-- Header -->
        <div class="mb-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold leading-6 text-gray-900 sm:text-3xl sm:truncate">
                        👥 Editar Cliente
                    </h1>
                    <p class="mt-2 text-sm text-gray-700">
                        Actualiza la información de {{ $cleanClient->company_name }}
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none space-x-3">
                    <a href="{{ route('admin.clean.clients.show', $cleanClient) }}" 
                       class="inline-flex items-center justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                            <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A11.8 11.8 0 0110 1.5c3.969 0 7.663 2.147 9.336 5.904.274.558.274 1.228 0 1.786A11.8 11.8 0 0110 17.5c-3.969 0-7.663-2.147-9.336-5.904zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        Ver Cliente
                    </a>
                    <a href="{{ route('admin.clean.clients.index') }}" 
                       class="inline-flex items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.793 2.232a.75.75 0 01-.025 1.06L3.622 7.25h10.003a5.375 5.375 0 010 10.75H10.75a.75.75 0 010-1.5h2.875a3.875 3.875 0 000-7.75H3.622l4.146 3.957a.75.75 0 01-1.036 1.085l-5.5-5.25a.75.75 0 010-1.085l5.5-5.25a.75.75 0 011.06.025z" clip-rule="evenodd" />
                        </svg>
                        Volver a Clientes
                    </a>
                </div>
            </div>
        </div>

        <!-- Información del Cliente -->
        <div class="mb-6 rounded-lg bg-white p-4 shadow">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100">
                        <span class="text-lg">{{ $cleanClient->getIndustryInfo()['icon'] }}</span>
                    </div>
                </div>
                <div class="min-w-0 flex-1">
                    <h2 class="text-lg font-semibold text-gray-900">{{ $cleanClient->company_name }}</h2>
                    <p class="text-sm text-gray-500">{{ $cleanClient->contact_name }} • {{ $cleanClient->contact_email }}</p>
                </div>
                <div class="flex space-x-2">
                    @php $riskInfo = $cleanClient->getRiskLevelInfo() @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                               @if($riskInfo['color'] === 'green') bg-green-100 text-green-800
                               @elseif($riskInfo['color'] === 'yellow') bg-yellow-100 text-yellow-800
                               @else bg-red-100 text-red-800 @endif">
                        {{ $riskInfo['label'] }}
                    </span>
                    @if($cleanClient->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            ✅ Activo
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            ❌ Inactivo
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white shadow sm:rounded-lg">
            <form method="POST" action="{{ route('admin.clean.clients.update', $cleanClient) }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="px-4 py-6 sm:px-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        
                        <!-- Información Básica -->
                        <div class="sm:col-span-3">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Información Básica</h3>
                        </div>

                        <!-- Nombre de la Empresa -->
                        <div class="sm:col-span-2">
                            <label for="company_name" class="block text-sm font-medium text-gray-700">
                                Nombre de la Empresa *
                            </label>
                            <input type="text" 
                                   name="company_name" 
                                   id="company_name"
                                   value="{{ old('company_name', $cleanClient->company_name) }}"
                                   required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('company_name') border-red-300 @enderror">
                            @error('company_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- RFC/Tax ID -->
                        <div>
                            <label for="tax_id" class="block text-sm font-medium text-gray-700">
                                RFC / Tax ID
                            </label>
                            <input type="text" 
                                   name="tax_id" 
                                   id="tax_id"
                                   value="{{ old('tax_id', $cleanClient->tax_id) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('tax_id') border-red-300 @enderror">
                            @error('tax_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Información de Contacto -->
                        <div class="sm:col-span-3">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4 mt-8">Información de Contacto</h3>
                        </div>

                        <!-- Nombre del Contacto -->
                        <div>
                            <label for="contact_name" class="block text-sm font-medium text-gray-700">
                                Nombre del Contacto *
                            </label>
                            <input type="text" 
                                   name="contact_name" 
                                   id="contact_name"
                                   value="{{ old('contact_name', $cleanClient->contact_name) }}"
                                   required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('contact_name') border-red-300 @enderror">
                            @error('contact_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="contact_email" class="block text-sm font-medium text-gray-700">
                                Email de Contacto *
                            </label>
                            <input type="email" 
                                   name="contact_email" 
                                   id="contact_email"
                                   value="{{ old('contact_email', $cleanClient->contact_email) }}"
                                   required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('contact_email') border-red-300 @enderror">
                            @error('contact_email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teléfono Principal -->
                        <div>
                            <label for="contact_phone" class="block text-sm font-medium text-gray-700">
                                Teléfono Principal
                            </label>
                            <input type="tel" 
                                   name="contact_phone" 
                                   id="contact_phone"
                                   value="{{ old('contact_phone', $cleanClient->contact_phone) }}"
                                   placeholder="+52 55 1234 5678"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('contact_phone') border-red-300 @enderror">
                            @error('contact_phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teléfono Secundario -->
                        <div>
                            <label for="secondary_phone" class="block text-sm font-medium text-gray-700">
                                Teléfono Secundario
                            </label>
                            <input type="tel" 
                                   name="secondary_phone" 
                                   id="secondary_phone"
                                   value="{{ old('secondary_phone', $cleanClient->secondary_phone) }}"
                                   placeholder="+52 55 1234 5678"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('secondary_phone') border-red-300 @enderror">
                            @error('secondary_phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Website -->
                        <div>
                            <label for="website" class="block text-sm font-medium text-gray-700">
                                Sitio Web
                            </label>
                            <input type="url" 
                                   name="website" 
                                   id="website"
                                   value="{{ old('website', $cleanClient->website) }}"
                                   placeholder="https://www.ejemplo.com"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('website') border-red-300 @enderror">
                            @error('website')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Método de Contacto Preferido -->
                        <div>
                            <label for="preferred_contact_method" class="block text-sm font-medium text-gray-700">
                                Método de Contacto Preferido *
                            </label>
                            <select name="preferred_contact_method" 
                                    id="preferred_contact_method"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('preferred_contact_method') border-red-300 @enderror">
                                <option value="">Seleccionar...</option>
                                <option value="email" {{ old('preferred_contact_method', $cleanClient->preferred_contact_method) === 'email' ? 'selected' : '' }}>📧 Email</option>
                                <option value="phone" {{ old('preferred_contact_method', $cleanClient->preferred_contact_method) === 'phone' ? 'selected' : '' }}>📞 Teléfono</option>
                                <option value="whatsapp" {{ old('preferred_contact_method', $cleanClient->preferred_contact_method) === 'whatsapp' ? 'selected' : '' }}>📱 WhatsApp</option>
                                <option value="in_person" {{ old('preferred_contact_method', $cleanClient->preferred_contact_method) === 'in_person' ? 'selected' : '' }}>🤝 Presencial</option>
                            </select>
                            @error('preferred_contact_method')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dirección -->
                        <div class="sm:col-span-3">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4 mt-8">Dirección</h3>
                        </div>

                        <!-- Dirección Completa -->
                        <div class="sm:col-span-3">
                            <label for="address" class="block text-sm font-medium text-gray-700">
                                Dirección Completa
                            </label>
                            <textarea name="address" 
                                      id="address"
                                      rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('address') border-red-300 @enderror">{{ old('address', $cleanClient->address) }}</textarea>
                            @error('address')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ciudad -->
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">
                                Ciudad
                            </label>
                            <input type="text" 
                                   name="city" 
                                   id="city"
                                   value="{{ old('city', $cleanClient->city) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('city') border-red-300 @enderror">
                            @error('city')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700">
                                Estado
                            </label>
                            <input type="text" 
                                   name="state" 
                                   id="state"
                                   value="{{ old('state', $cleanClient->state) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('state') border-red-300 @enderror">
                            @error('state')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Código Postal -->
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-gray-700">
                                Código Postal
                            </label>
                            <input type="text" 
                                   name="postal_code" 
                                   id="postal_code"
                                   value="{{ old('postal_code', $cleanClient->postal_code) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('postal_code') border-red-300 @enderror">
                            @error('postal_code')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Clasificación del Cliente -->
                        <div class="sm:col-span-3">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4 mt-8">Clasificación del Cliente</h3>
                        </div>

                        <!-- Industria -->
                        <div>
                            <label for="industry_type" class="block text-sm font-medium text-gray-700">
                                Tipo de Industria *
                            </label>
                            <select name="industry_type" 
                                    id="industry_type"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('industry_type') border-red-300 @enderror">
                                <option value="">Seleccionar...</option>
                                <option value="hospitality" {{ old('industry_type', $cleanClient->industry_type) === 'hospitality' ? 'selected' : '' }}>🏨 Hotelería</option>
                                <option value="healthcare" {{ old('industry_type', $cleanClient->industry_type) === 'healthcare' ? 'selected' : '' }}>🏥 Salud</option>
                                <option value="education" {{ old('industry_type', $cleanClient->industry_type) === 'education' ? 'selected' : '' }}>🏫 Educación</option>
                                <option value="office" {{ old('industry_type', $cleanClient->industry_type) === 'office' ? 'selected' : '' }}>🏢 Oficinas</option>
                                <option value="retail" {{ old('industry_type', $cleanClient->industry_type) === 'retail' ? 'selected' : '' }}>🏪 Retail</option>
                                <option value="restaurant" {{ old('industry_type', $cleanClient->industry_type) === 'restaurant' ? 'selected' : '' }}>🍽️ Restaurantes</option>
                                <option value="manufacturing" {{ old('industry_type', $cleanClient->industry_type) === 'manufacturing' ? 'selected' : '' }}>🏭 Manufactura</option>
                                <option value="government" {{ old('industry_type', $cleanClient->industry_type) === 'government' ? 'selected' : '' }}>🏛️ Gobierno</option>
                                <option value="other" {{ old('industry_type', $cleanClient->industry_type) === 'other' ? 'selected' : '' }}>🏢 Otro</option>
                            </select>
                            @error('industry_type')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tipo de Cliente -->
                        <div>
                            <label for="client_type" class="block text-sm font-medium text-gray-700">
                                Tipo de Cliente *
                            </label>
                            <select name="client_type" 
                                    id="client_type"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('client_type') border-red-300 @enderror">
                                <option value="">Seleccionar...</option>
                                <option value="corporate" {{ old('client_type', $cleanClient->client_type) === 'corporate' ? 'selected' : '' }}>Corporativo</option>
                                <option value="small_business" {{ old('client_type', $cleanClient->client_type) === 'small_business' ? 'selected' : '' }}>Pequeña Empresa</option>
                                <option value="government" {{ old('client_type', $cleanClient->client_type) === 'government' ? 'selected' : '' }}>Gobierno</option>
                                <option value="institution" {{ old('client_type', $cleanClient->client_type) === 'institution' ? 'selected' : '' }}>Institución</option>
                            </select>
                            @error('client_type')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nivel de Riesgo -->
                        <div>
                            <label for="risk_level" class="block text-sm font-medium text-gray-700">
                                Nivel de Riesgo *
                            </label>
                            <select name="risk_level" 
                                    id="risk_level"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('risk_level') border-red-300 @enderror">
                                <option value="">Seleccionar...</option>
                                <option value="low" {{ old('risk_level', $cleanClient->risk_level) === 'low' ? 'selected' : '' }}>🟢 Bajo Riesgo</option>
                                <option value="medium" {{ old('risk_level', $cleanClient->risk_level) === 'medium' ? 'selected' : '' }}>🟡 Riesgo Medio</option>
                                <option value="high" {{ old('risk_level', $cleanClient->risk_level) === 'high' ? 'selected' : '' }}>🔴 Alto Riesgo</option>
                            </select>
                            @error('risk_level')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estado del Cliente -->
                        <div class="sm:col-span-3">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4 mt-8">Estado del Cliente</h3>
                        </div>

                        <!-- Estado Activo -->
                        <div class="sm:col-span-3">
                            <div class="flex items-center">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" 
                                       name="is_active" 
                                       id="is_active"
                                       value="1"
                                       {{ old('is_active', $cleanClient->is_active) ? 'checked' : '' }}
                                       class="h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-600">
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                    Cliente activo
                                </label>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Los clientes inactivos no aparecerán en búsquedas por defecto</p>
                        </div>

                        <!-- Términos Comerciales -->
                        <div class="sm:col-span-3">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4 mt-8">Términos Comerciales</h3>
                        </div>

                        <!-- Límite de Crédito -->
                        <div>
                            <label for="credit_limit" class="block text-sm font-medium text-gray-700">
                                Límite de Crédito ($)
                            </label>
                            <input type="number" 
                                   name="credit_limit" 
                                   id="credit_limit"
                                   value="{{ old('credit_limit', $cleanClient->credit_limit) }}"
                                   min="0"
                                   step="0.01"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('credit_limit') border-red-300 @enderror">
                            @error('credit_limit')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Términos de Pago -->
                        <div>
                            <label for="payment_terms" class="block text-sm font-medium text-gray-700">
                                Términos de Pago (días)
                            </label>
                            <input type="number" 
                                   name="payment_terms" 
                                   id="payment_terms"
                                   value="{{ old('payment_terms', $cleanClient->payment_terms) }}"
                                   min="1"
                                   max="365"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('payment_terms') border-red-300 @enderror">
                            @error('payment_terms')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descuento -->
                        <div>
                            <label for="discount_percentage" class="block text-sm font-medium text-gray-700">
                                Descuento (%)
                            </label>
                            <input type="number" 
                                   name="discount_percentage" 
                                   id="discount_percentage"
                                   value="{{ old('discount_percentage', $cleanClient->discount_percentage) }}"
                                   min="0"
                                   max="100"
                                   step="0.01"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('discount_percentage') border-red-300 @enderror">
                            @error('discount_percentage')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Historial Comercial -->
                        <div class="sm:col-span-3">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4 mt-8">Historial Comercial</h3>
                        </div>

                        <!-- Fecha de Adquisición -->
                        <div>
                            <label for="acquisition_date" class="block text-sm font-medium text-gray-700">
                                Fecha de Adquisición
                            </label>
                            <input type="date" 
                                   name="acquisition_date" 
                                   id="acquisition_date"
                                   value="{{ old('acquisition_date', $cleanClient->acquisition_date?->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('acquisition_date') border-red-300 @enderror">
                            @error('acquisition_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Última Compra -->
                        <div>
                            <label for="last_purchase_date" class="block text-sm font-medium text-gray-700">
                                Última Fecha de Compra
                            </label>
                            <input type="date" 
                                   name="last_purchase_date" 
                                   id="last_purchase_date"
                                   value="{{ old('last_purchase_date', $cleanClient->last_purchase_date?->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('last_purchase_date') border-red-300 @enderror">
                            @error('last_purchase_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Total de Compras -->
                        <div>
                            <label for="total_purchases" class="block text-sm font-medium text-gray-700">
                                Total de Compras ($)
                            </label>
                            <input type="number" 
                                   name="total_purchases" 
                                   id="total_purchases"
                                   value="{{ old('total_purchases', $cleanClient->total_purchases) }}"
                                   min="0"
                                   step="0.01"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('total_purchases') border-red-300 @enderror">
                            @error('total_purchases')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Información Operativa -->
                        <div class="sm:col-span-3">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4 mt-8">Información Operativa</h3>
                        </div>

                        <!-- Frecuencia de Limpieza -->
                        <div>
                            <label for="cleaning_frequency" class="block text-sm font-medium text-gray-700">
                                Frecuencia de Limpieza *
                            </label>
                            <select name="cleaning_frequency" 
                                    id="cleaning_frequency"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('cleaning_frequency') border-red-300 @enderror">
                                <option value="">Seleccionar...</option>
                                <option value="daily" {{ old('cleaning_frequency', $cleanClient->cleaning_frequency) === 'daily' ? 'selected' : '' }}>Diaria</option>
                                <option value="weekly" {{ old('cleaning_frequency', $cleanClient->cleaning_frequency) === 'weekly' ? 'selected' : '' }}>Semanal</option>
                                <option value="bi_weekly" {{ old('cleaning_frequency', $cleanClient->cleaning_frequency) === 'bi_weekly' ? 'selected' : '' }}>Quincenal</option>
                                <option value="monthly" {{ old('cleaning_frequency', $cleanClient->cleaning_frequency) === 'monthly' ? 'selected' : '' }}>Mensual</option>
                                <option value="as_needed" {{ old('cleaning_frequency', $cleanClient->cleaning_frequency) === 'as_needed' ? 'selected' : '' }}>Según necesidad</option>
                            </select>
                            @error('cleaning_frequency')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tamaño de Instalación -->
                        <div>
                            <label for="facility_size" class="block text-sm font-medium text-gray-700">
                                Tamaño de Instalación (m²)
                            </label>
                            <input type="number" 
                                   name="facility_size" 
                                   id="facility_size"
                                   value="{{ old('facility_size', $cleanClient->facility_size) }}"
                                   min="1"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('facility_size') border-red-300 @enderror">
                            @error('facility_size')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Número de Empleados -->
                        <div>
                            <label for="number_of_employees" class="block text-sm font-medium text-gray-700">
                                Número de Empleados
                            </label>
                            <input type="number" 
                                   name="number_of_employees" 
                                   id="number_of_employees"
                                   value="{{ old('number_of_employees', $cleanClient->number_of_employees) }}"
                                   min="1"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('number_of_employees') border-red-300 @enderror">
                            @error('number_of_employees')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gestión de Cuenta -->
                        <div class="sm:col-span-3">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4 mt-8">Gestión de Cuenta</h3>
                        </div>

                        <!-- Gerente de Cuenta -->
                        <div>
                            <label for="account_manager" class="block text-sm font-medium text-gray-700">
                                Gerente de Cuenta
                            </label>
                            <input type="text" 
                                   name="account_manager" 
                                   id="account_manager"
                                   value="{{ old('account_manager', $cleanClient->account_manager) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('account_manager') border-red-300 @enderror">
                            @error('account_manager')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notas -->
                        <div class="sm:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-gray-700">
                                Notas Adicionales
                            </label>
                            <textarea name="notes" 
                                      id="notes"
                                      rows="4"
                                      placeholder="Información adicional relevante sobre el cliente..."
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('notes') border-red-300 @enderror">{{ old('notes', $cleanClient->notes) }}</textarea>
                            @error('notes')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Instrucciones de Entrega -->
                        <div class="sm:col-span-3">
                            <label for="delivery_instructions" class="block text-sm font-medium text-gray-700">
                                Instrucciones de Entrega
                            </label>
                            <textarea name="delivery_instructions" 
                                      id="delivery_instructions"
                                      rows="3"
                                      placeholder="Detalles específicos para entregas, horarios, contactos especiales..."
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('delivery_instructions') border-red-300 @enderror">{{ old('delivery_instructions', $cleanClient->delivery_instructions) }}</textarea>
                            @error('delivery_instructions')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.clean.clients.show', $cleanClient) }}" 
                           class="inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex justify-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                            💾 Actualizar Cliente
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection