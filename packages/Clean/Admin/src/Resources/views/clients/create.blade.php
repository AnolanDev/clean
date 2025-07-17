@extends('clean-admin::layouts.admin')

@section('title', 'Crear Cliente')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 sm:p-6 lg:p-8">
    <div class="mx-auto max-w-4xl">
        <!-- Header -->
        <div class="mb-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold leading-6 text-gray-900 sm:text-3xl sm:truncate">
                        👥 Crear Nuevo Cliente
                    </h1>
                    <p class="mt-2 text-sm text-gray-700">
                        Registra un nuevo cliente en tu cartera comercial
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
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

        <!-- Formulario -->
        <div class="bg-white shadow sm:rounded-lg">
            <form method="POST" action="{{ route('admin.clean.clients.store') }}" class="space-y-6">
                @csrf
                
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
                                   value="{{ old('company_name') }}"
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
                                   value="{{ old('tax_id') }}"
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
                                   value="{{ old('contact_name') }}"
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
                                   value="{{ old('contact_email') }}"
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
                                   value="{{ old('contact_phone') }}"
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
                                   value="{{ old('secondary_phone') }}"
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
                                   value="{{ old('website') }}"
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
                                <option value="email" {{ old('preferred_contact_method') === 'email' ? 'selected' : '' }}>📧 Email</option>
                                <option value="phone" {{ old('preferred_contact_method') === 'phone' ? 'selected' : '' }}>📞 Teléfono</option>
                                <option value="whatsapp" {{ old('preferred_contact_method') === 'whatsapp' ? 'selected' : '' }}>📱 WhatsApp</option>
                                <option value="in_person" {{ old('preferred_contact_method') === 'in_person' ? 'selected' : '' }}>🤝 Presencial</option>
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
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('address') border-red-300 @enderror">{{ old('address') }}</textarea>
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
                                   value="{{ old('city') }}"
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
                                   value="{{ old('state') }}"
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
                                   value="{{ old('postal_code') }}"
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
                                <option value="hospitality" {{ old('industry_type') === 'hospitality' ? 'selected' : '' }}>🏨 Hotelería</option>
                                <option value="healthcare" {{ old('industry_type') === 'healthcare' ? 'selected' : '' }}>🏥 Salud</option>
                                <option value="education" {{ old('industry_type') === 'education' ? 'selected' : '' }}>🏫 Educación</option>
                                <option value="office" {{ old('industry_type') === 'office' ? 'selected' : '' }}>🏢 Oficinas</option>
                                <option value="retail" {{ old('industry_type') === 'retail' ? 'selected' : '' }}>🏪 Retail</option>
                                <option value="restaurant" {{ old('industry_type') === 'restaurant' ? 'selected' : '' }}>🍽️ Restaurantes</option>
                                <option value="manufacturing" {{ old('industry_type') === 'manufacturing' ? 'selected' : '' }}>🏭 Manufactura</option>
                                <option value="government" {{ old('industry_type') === 'government' ? 'selected' : '' }}>🏛️ Gobierno</option>
                                <option value="other" {{ old('industry_type') === 'other' ? 'selected' : '' }}>🏢 Otro</option>
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
                                <option value="corporate" {{ old('client_type') === 'corporate' ? 'selected' : '' }}>Corporativo</option>
                                <option value="small_business" {{ old('client_type') === 'small_business' ? 'selected' : '' }}>Pequeña Empresa</option>
                                <option value="government" {{ old('client_type') === 'government' ? 'selected' : '' }}>Gobierno</option>
                                <option value="institution" {{ old('client_type') === 'institution' ? 'selected' : '' }}>Institución</option>
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
                                <option value="low" {{ old('risk_level') === 'low' ? 'selected' : '' }}>🟢 Bajo Riesgo</option>
                                <option value="medium" {{ old('risk_level') === 'medium' ? 'selected' : '' }}>🟡 Riesgo Medio</option>
                                <option value="high" {{ old('risk_level') === 'high' ? 'selected' : '' }}>🔴 Alto Riesgo</option>
                            </select>
                            @error('risk_level')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
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
                                   value="{{ old('credit_limit', 0) }}"
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
                                   value="{{ old('payment_terms', 30) }}"
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
                                   value="{{ old('discount_percentage', 0) }}"
                                   min="0"
                                   max="100"
                                   step="0.01"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('discount_percentage') border-red-300 @enderror">
                            @error('discount_percentage')
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
                                <option value="daily" {{ old('cleaning_frequency') === 'daily' ? 'selected' : '' }}>Diaria</option>
                                <option value="weekly" {{ old('cleaning_frequency') === 'weekly' ? 'selected' : '' }}>Semanal</option>
                                <option value="bi_weekly" {{ old('cleaning_frequency') === 'bi_weekly' ? 'selected' : '' }}>Quincenal</option>
                                <option value="monthly" {{ old('cleaning_frequency') === 'monthly' ? 'selected' : '' }}>Mensual</option>
                                <option value="as_needed" {{ old('cleaning_frequency') === 'as_needed' ? 'selected' : '' }}>Según necesidad</option>
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
                                   value="{{ old('facility_size') }}"
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
                                   value="{{ old('number_of_employees') }}"
                                   min="1"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('number_of_employees') border-red-300 @enderror">
                            @error('number_of_employees')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notas -->
                        <div class="sm:col-span-3">
                            <label for="notes" class="block text-sm font-medium text-gray-700">
                                Notas Adicionales
                            </label>
                            <textarea name="notes" 
                                      id="notes"
                                      rows="4"
                                      placeholder="Información adicional relevante sobre el cliente..."
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('notes') border-red-300 @enderror">{{ old('notes') }}</textarea>
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
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('delivery_instructions') border-red-300 @enderror">{{ old('delivery_instructions') }}</textarea>
                            @error('delivery_instructions')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.clean.clients.index') }}" 
                           class="inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex justify-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                            💾 Crear Cliente
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection