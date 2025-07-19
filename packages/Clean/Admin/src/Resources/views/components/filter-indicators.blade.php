@props(['filters' => [], 'route' => null, 'title' => 'Filtros aplicados'])

@php
    $hasFilters = collect($filters)->filter(fn($value) => !empty($value) || $value === '0')->isNotEmpty();
    $filterCount = collect($filters)->filter(fn($value) => !empty($value) || $value === '0')->count();
@endphp

@if($hasFilters)
    <div {{ $attributes->merge(['class' => 'mb-4 flex items-center justify-between rounded-md bg-blue-50 p-3']) }}>
        <div class="flex items-center">
            <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z" />
            </svg>
            <span class="ml-2 text-sm font-medium text-blue-900">
                {{ $title }}: {{ $filterCount }}
            </span>
        </div>
        
        <div class="flex items-center space-x-2">
            @if($route)
                <a href="{{ $route }}" 
                   class="text-sm font-medium text-blue-600 hover:text-blue-500">
                    Limpiar filtros
                </a>
            @endif
        </div>
    </div>
@endif