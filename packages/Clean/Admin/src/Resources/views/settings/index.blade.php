<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - Clean Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
            color: #2d3748;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.2s;
        }
        
        .nav-links a:hover {
            background-color: rgba(255,255,255,0.1);
        }
        
        .page-header {
            background: white;
            padding: 2rem 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .page-title {
            font-size: 2rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        
        .settings-layout {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .settings-sidebar {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            height: fit-content;
            overflow: hidden;
        }
        
        .sidebar-header {
            background: #f7fafc;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .sidebar-header h3 {
            color: #4a5568;
            font-size: 1.1rem;
        }
        
        .sidebar-menu {
            padding: 0;
        }
        
        .sidebar-item {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .sidebar-item:hover {
            background: #f8fafc;
        }
        
        .sidebar-item.active {
            background: #667eea;
            color: white;
        }
        
        .sidebar-item:last-child {
            border-bottom: none;
        }
        
        .sidebar-icon {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }
        
        .sidebar-text {
            font-weight: 500;
        }
        
        .settings-content {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .content-header {
            background: #f7fafc;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .content-header h3 {
            color: #4a5568;
            font-size: 1.3rem;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background: #667eea;
            color: white;
        }
        
        .btn-primary:hover {
            background: #5a6fd8;
        }
        
        .btn-secondary {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .btn-secondary:hover {
            background: #cbd5e0;
        }
        
        .btn-success {
            background: #48bb78;
            color: white;
        }
        
        .btn-success:hover {
            background: #38a169;
        }
        
        .btn-danger {
            background: #f56565;
            color: white;
        }
        
        .btn-danger:hover {
            background: #e53e3e;
        }
        
        .settings-section {
            display: none;
            padding: 2rem;
        }
        
        .settings-section.active {
            display: block;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #4a5568;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            font-size: 0.9rem;
            transition: border-color 0.2s;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-group .help-text {
            color: #718096;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .checkbox-group input[type="checkbox"] {
            width: auto;
        }
        
        .checkbox-group label {
            margin-bottom: 0;
            font-weight: normal;
        }
        
        .settings-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .settings-card h4 {
            margin-bottom: 1rem;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .settings-card p {
            color: #4a5568;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        
        .danger-zone {
            background: #fed7d7;
            border: 1px solid #f56565;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 2rem;
        }
        
        .danger-zone h4 {
            color: #742a2a;
            margin-bottom: 1rem;
        }
        
        .danger-zone p {
            color: #742a2a;
            margin-bottom: 1rem;
        }
        
        .actions-bar {
            background: #f7fafc;
            padding: 1rem 2rem;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .actions-left {
            color: #4a5568;
            font-size: 0.9rem;
        }
        
        .actions-right {
            display: flex;
            gap: 1rem;
        }
        
        .status-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #f0fff4;
            border: 1px solid #48bb78;
            border-radius: 5px;
            color: #22543d;
            font-size: 0.9rem;
        }
        
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #48bb78;
        }
        
        .integration-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .integration-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .integration-icon {
            font-size: 2rem;
            width: 50px;
            height: 50px;
            background: #f7fafc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .integration-details h5 {
            margin-bottom: 0.25rem;
            color: #2d3748;
        }
        
        .integration-details p {
            color: #4a5568;
            font-size: 0.9rem;
        }
        
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }
        
        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .toggle-slider {
            background-color: #667eea;
        }
        
        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }
        
        .backup-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .backup-info h5 {
            margin-bottom: 0.25rem;
            color: #2d3748;
        }
        
        .backup-info p {
            color: #4a5568;
            font-size: 0.9rem;
        }
        
        .backup-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .success-message {
            background: #f0fff4;
            border: 1px solid #48bb78;
            color: #22543d;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            display: none;
        }
        
        .error-message {
            background: #fed7d7;
            border: 1px solid #f56565;
            color: #742a2a;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">🧽 Clean Admin</div>
                <nav class="nav-links">
                    <a href="{{ route('admin.clean.dashboard') }}">Dashboard</a>
                    <a href="{{ route('admin.clean.products') }}">Productos</a>
                    <a href="{{ route('admin.clean.brands.index') }}">Marcas</a>
                    <a href="{{ route('admin.clean.categories.index') }}">Categorías</a>
                    <a href="{{ route('admin.clean.ingredients.index') }}">Ingredientes</a>
                    <a href="{{ route('admin.clean.safety') }}">Seguridad</a>
                    <a href="{{ route('admin.clean.analytics') }}">Análisis</a>
                    <a href="{{ route('admin.clean.settings') }}">Configuración</a>
                </nav>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">⚙️ Configuración del Sistema</h1>
            <p>Administra todas las configuraciones del sistema Clean</p>
        </div>

        <div class="settings-layout">
            <!-- Sidebar de navegación -->
            <div class="settings-sidebar">
                <div class="sidebar-header">
                    <h3>Configuración</h3>
                </div>
                <div class="sidebar-menu">
                    <div class="sidebar-item active" onclick="showSection('general')">
                        <div class="sidebar-icon">🏢</div>
                        <div class="sidebar-text">General</div>
                    </div>
                    <div class="sidebar-item" onclick="showSection('catalog')">
                        <div class="sidebar-icon">📦</div>
                        <div class="sidebar-text">Catálogo</div>
                    </div>
                    <div class="sidebar-item" onclick="showSection('safety')">
                        <div class="sidebar-icon">🛡️</div>
                        <div class="sidebar-text">Seguridad</div>
                    </div>
                    <div class="sidebar-item" onclick="showSection('filters')">
                        <div class="sidebar-icon">🔍</div>
                        <div class="sidebar-text">Filtros</div>
                    </div>
                    <div class="sidebar-item" onclick="showSection('integrations')">
                        <div class="sidebar-icon">🔗</div>
                        <div class="sidebar-text">Integraciones</div>
                    </div>
                    <div class="sidebar-item" onclick="showSection('backup')">
                        <div class="sidebar-icon">💾</div>
                        <div class="sidebar-text">Backup</div>
                    </div>
                    <div class="sidebar-item" onclick="showSection('advanced')">
                        <div class="sidebar-icon">⚡</div>
                        <div class="sidebar-text">Avanzado</div>
                    </div>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="settings-content">
                <form id="settings-form" action="{{ route('admin.clean.settings.update') }}" method="POST">
                    @csrf
                    
                    <!-- Mensajes de estado -->
                    <div id="success-message" class="success-message">
                        ✅ Configuración guardada correctamente
                    </div>
                    <div id="error-message" class="error-message">
                        ❌ Error al guardar la configuración
                    </div>

                    <!-- Sección General -->
                    <div id="general-section" class="settings-section active">
                        <div class="content-header">
                            <h3>🏢 Configuración General</h3>
                            <div class="status-indicator">
                                <div class="status-dot"></div>
                                Sistema activo
                            </div>
                        </div>
                        
                        <div class="settings-card">
                            <h4>🏢 Información de la Empresa</h4>
                            <p>Configuración básica de la empresa y datos de contacto</p>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="company_name">Nombre de la Empresa</label>
                                    <input type="text" id="company_name" name="settings[company_name]" 
                                           value="{{ $settings['general']['company_name'] ?? 'Clean Products Co.' }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="company_email">Email de Contacto</label>
                                    <input type="email" id="company_email" name="settings[company_email]" 
                                           value="{{ $settings['general']['company_email'] ?? 'contact@cleanproducts.com' }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="company_phone">Teléfono</label>
                                    <input type="tel" id="company_phone" name="settings[company_phone]" 
                                           value="{{ $settings['general']['company_phone'] ?? '+1-800-CLEAN' }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="company_website">Sitio Web</label>
                                    <input type="url" id="company_website" name="settings[company_website]" 
                                           value="{{ $settings['general']['company_website'] ?? 'https://cleanproducts.com' }}">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="company_address">Dirección</label>
                                <textarea id="company_address" name="settings[company_address]" 
                                          placeholder="Dirección completa de la empresa">{{ $settings['general']['company_address'] ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="settings-card">
                            <h4>🌐 Configuración Regional</h4>
                            <p>Idioma, zona horaria y configuración regional</p>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="default_language">Idioma por Defecto</label>
                                    <select id="default_language" name="settings[default_language]">
                                        <option value="es" {{ ($settings['general']['default_language'] ?? 'es') == 'es' ? 'selected' : '' }}>Español</option>
                                        <option value="en" {{ ($settings['general']['default_language'] ?? 'es') == 'en' ? 'selected' : '' }}>English</option>
                                        <option value="fr" {{ ($settings['general']['default_language'] ?? 'es') == 'fr' ? 'selected' : '' }}>Français</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="timezone">Zona Horaria</label>
                                    <select id="timezone" name="settings[timezone]">
                                        <option value="America/Mexico_City" {{ ($settings['general']['timezone'] ?? 'America/Mexico_City') == 'America/Mexico_City' ? 'selected' : '' }}>México (UTC-6)</option>
                                        <option value="America/New_York" {{ ($settings['general']['timezone'] ?? 'America/Mexico_City') == 'America/New_York' ? 'selected' : '' }}>New York (UTC-5)</option>
                                        <option value="Europe/Madrid" {{ ($settings['general']['timezone'] ?? 'America/Mexico_City') == 'Europe/Madrid' ? 'selected' : '' }}>Madrid (UTC+1)</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="currency">Moneda</label>
                                    <select id="currency" name="settings[currency]">
                                        <option value="MXN" {{ ($settings['general']['currency'] ?? 'MXN') == 'MXN' ? 'selected' : '' }}>Peso Mexicano (MXN)</option>
                                        <option value="USD" {{ ($settings['general']['currency'] ?? 'MXN') == 'USD' ? 'selected' : '' }}>Dólar Americano (USD)</option>
                                        <option value="EUR" {{ ($settings['general']['currency'] ?? 'MXN') == 'EUR' ? 'selected' : '' }}>Euro (EUR)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección Catálogo -->
                    <div id="catalog-section" class="settings-section">
                        <div class="content-header">
                            <h3>📦 Configuración del Catálogo</h3>
                            <button type="button" class="btn btn-secondary" onclick="resetCatalogSettings()">🔄 Restaurar</button>
                        </div>
                        
                        <div class="settings-card">
                            <h4>📋 Configuración de Productos</h4>
                            <p>Opciones para la gestión y visualización de productos</p>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="products_per_page">Productos por Página</label>
                                    <input type="number" id="products_per_page" name="settings[products_per_page]" 
                                           value="{{ $settings['catalog']['products_per_page'] ?? 20 }}" min="5" max="100">
                                    <div class="help-text">Número de productos mostrados en listados</div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="default_sort">Ordenamiento por Defecto</label>
                                    <select id="default_sort" name="settings[default_sort]">
                                        <option value="name" {{ ($settings['catalog']['default_sort'] ?? 'name') == 'name' ? 'selected' : '' }}>Nombre A-Z</option>
                                        <option value="price" {{ ($settings['catalog']['default_sort'] ?? 'name') == 'price' ? 'selected' : '' }}>Precio</option>
                                        <option value="safety" {{ ($settings['catalog']['default_sort'] ?? 'name') == 'safety' ? 'selected' : '' }}>Seguridad</option>
                                        <option value="eco_score" {{ ($settings['catalog']['default_sort'] ?? 'name') == 'eco_score' ? 'selected' : '' }}>Score Ecológico</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="show_eco_badges" name="settings[show_eco_badges]" 
                                       {{ ($settings['catalog']['show_eco_badges'] ?? true) ? 'checked' : '' }}>
                                <label for="show_eco_badges">Mostrar badges ecológicos</label>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="show_safety_indicators" name="settings[show_safety_indicators]" 
                                       {{ ($settings['catalog']['show_safety_indicators'] ?? true) ? 'checked' : '' }}>
                                <label for="show_safety_indicators">Mostrar indicadores de seguridad</label>
                            </div>
                        </div>
                    </div>

                    <!-- Sección Seguridad -->
                    <div id="safety-section" class="settings-section">
                        <div class="content-header">
                            <h3>🛡️ Configuración de Seguridad</h3>
                            <button type="button" class="btn btn-secondary" onclick="runSafetyCheck()">🔍 Verificar</button>
                        </div>
                        
                        <div class="settings-card">
                            <h4>⚠️ Límites de Seguridad</h4>
                            <p>Configuración de límites y alertas de seguridad</p>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="max_hazardous_ingredients">Máximo Ingredientes Peligrosos</label>
                                    <input type="number" id="max_hazardous_ingredients" name="settings[max_hazardous_ingredients]" 
                                           value="{{ $settings['safety']['max_hazardous_ingredients'] ?? 3 }}" min="0" max="10">
                                    <div class="help-text">Número máximo de ingredientes peligrosos por producto</div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="safety_review_period">Período de Revisión (días)</label>
                                    <input type="number" id="safety_review_period" name="settings[safety_review_period]" 
                                           value="{{ $settings['safety']['safety_review_period'] ?? 90 }}" min="30" max="365">
                                    <div class="help-text">Frecuencia de revisión de clasificaciones de seguridad</div>
                                </div>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="auto_safety_alerts" name="settings[auto_safety_alerts]" 
                                       {{ ($settings['safety']['auto_safety_alerts'] ?? true) ? 'checked' : '' }}>
                                <label for="auto_safety_alerts">Generar alertas automáticas</label>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="strict_mode" name="settings[strict_mode]" 
                                       {{ ($settings['safety']['strict_mode'] ?? false) ? 'checked' : '' }}>
                                <label for="strict_mode">Modo estricto de seguridad</label>
                            </div>
                        </div>
                    </div>

                    <!-- Sección Filtros -->
                    <div id="filters-section" class="settings-section">
                        <div class="content-header">
                            <h3>🔍 Configuración de Filtros</h3>
                            <button type="button" class="btn btn-primary" onclick="addCustomFilter()">➕ Agregar Filtro</button>
                        </div>
                        
                        <div class="settings-card">
                            <h4>🔧 Filtros Habilitados</h4>
                            <p>Activa o desactiva los filtros disponibles para usuarios</p>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="filter_by_brand" name="settings[filters][brand]" 
                                       {{ ($settings['filters']['brand'] ?? true) ? 'checked' : '' }}>
                                <label for="filter_by_brand">Filtrar por marca</label>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="filter_by_category" name="settings[filters][category]" 
                                       {{ ($settings['filters']['category'] ?? true) ? 'checked' : '' }}>
                                <label for="filter_by_category">Filtrar por categoría</label>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="filter_by_safety" name="settings[filters][safety]" 
                                       {{ ($settings['filters']['safety'] ?? true) ? 'checked' : '' }}>
                                <label for="filter_by_safety">Filtrar por seguridad</label>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="filter_by_eco" name="settings[filters][eco]" 
                                       {{ ($settings['filters']['eco'] ?? true) ? 'checked' : '' }}>
                                <label for="filter_by_eco">Filtrar por productos ecológicos</label>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="filter_by_price" name="settings[filters][price]" 
                                       {{ ($settings['filters']['price'] ?? true) ? 'checked' : '' }}>
                                <label for="filter_by_price">Filtrar por precio</label>
                            </div>
                        </div>
                    </div>

                    <!-- Sección Integraciones -->
                    <div id="integrations-section" class="settings-section">
                        <div class="content-header">
                            <h3>🔗 Integraciones</h3>
                            <button type="button" class="btn btn-primary" onclick="testAllIntegrations()">🧪 Probar Todas</button>
                        </div>
                        
                        <div class="settings-card">
                            <h4>📊 Servicios Externos</h4>
                            <p>Configuración de integraciones con servicios externos</p>
                            
                            <div class="integration-item">
                                <div class="integration-info">
                                    <div class="integration-icon">📊</div>
                                    <div class="integration-details">
                                        <h5>Google Analytics</h5>
                                        <p>Seguimiento de analytics y métricas</p>
                                    </div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="settings[integrations][google_analytics]" 
                                           {{ ($settings['integrations']['google_analytics'] ?? false) ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <div class="integration-item">
                                <div class="integration-info">
                                    <div class="integration-icon">🤖</div>
                                    <div class="integration-details">
                                        <h5>OpenAI API</h5>
                                        <p>Generación de contenido con IA</p>
                                    </div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="settings[integrations][openai]" 
                                           {{ ($settings['integrations']['openai'] ?? false) ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <div class="integration-item">
                                <div class="integration-info">
                                    <div class="integration-icon">📧</div>
                                    <div class="integration-details">
                                        <h5>Email Marketing</h5>
                                        <p>Campañas de email automatizadas</p>
                                    </div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="settings[integrations][email_marketing]" 
                                           {{ ($settings['integrations']['email_marketing'] ?? false) ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Sección Backup -->
                    <div id="backup-section" class="settings-section">
                        <div class="content-header">
                            <h3>💾 Backup y Restauración</h3>
                            <button type="button" class="btn btn-primary" onclick="createBackup()">📦 Crear Backup</button>
                        </div>
                        
                        <div class="settings-card">
                            <h4>⚙️ Configuración de Backup</h4>
                            <p>Programación y configuración de respaldos automáticos</p>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="backup_frequency">Frecuencia de Backup</label>
                                    <select id="backup_frequency" name="settings[backup_frequency]">
                                        <option value="daily" {{ ($settings['backup']['frequency'] ?? 'daily') == 'daily' ? 'selected' : '' }}>Diario</option>
                                        <option value="weekly" {{ ($settings['backup']['frequency'] ?? 'daily') == 'weekly' ? 'selected' : '' }}>Semanal</option>
                                        <option value="monthly" {{ ($settings['backup']['frequency'] ?? 'daily') == 'monthly' ? 'selected' : '' }}>Mensual</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="backup_retention">Retención (días)</label>
                                    <input type="number" id="backup_retention" name="settings[backup_retention]" 
                                           value="{{ $settings['backup']['retention'] ?? 30 }}" min="1" max="365">
                                </div>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="auto_backup" name="settings[auto_backup]" 
                                       {{ ($settings['backup']['auto_backup'] ?? true) ? 'checked' : '' }}>
                                <label for="auto_backup">Backup automático</label>
                            </div>
                        </div>
                        
                        <div class="settings-card">
                            <h4>📋 Backups Recientes</h4>
                            <p>Lista de respaldos disponibles</p>
                            
                            <div class="backup-item">
                                <div class="backup-info">
                                    <h5>Backup Completo</h5>
                                    <p>Creado: {{ date('d/m/Y H:i') }} - Tamaño: 45.2 MB</p>
                                </div>
                                <div class="backup-actions">
                                    <button type="button" class="btn btn-secondary" onclick="downloadBackup('full')">📥 Descargar</button>
                                    <button type="button" class="btn btn-primary" onclick="restoreBackup('full')">🔄 Restaurar</button>
                                </div>
                            </div>
                            
                            <div class="backup-item">
                                <div class="backup-info">
                                    <h5>Backup Base de Datos</h5>
                                    <p>Creado: {{ date('d/m/Y H:i', strtotime('-1 day')) }} - Tamaño: 12.8 MB</p>
                                </div>
                                <div class="backup-actions">
                                    <button type="button" class="btn btn-secondary" onclick="downloadBackup('db')">📥 Descargar</button>
                                    <button type="button" class="btn btn-primary" onclick="restoreBackup('db')">🔄 Restaurar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección Avanzado -->
                    <div id="advanced-section" class="settings-section">
                        <div class="content-header">
                            <h3>⚡ Configuración Avanzada</h3>
                            <button type="button" class="btn btn-secondary" onclick="clearAllCaches()">🧹 Limpiar Caché</button>
                        </div>
                        
                        <div class="settings-card">
                            <h4>🚀 Rendimiento</h4>
                            <p>Configuración de caché y optimización</p>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="enable_cache" name="settings[enable_cache]" 
                                       {{ ($settings['advanced']['enable_cache'] ?? true) ? 'checked' : '' }}>
                                <label for="enable_cache">Habilitar caché</label>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="enable_compression" name="settings[enable_compression]" 
                                       {{ ($settings['advanced']['enable_compression'] ?? true) ? 'checked' : '' }}>
                                <label for="enable_compression">Compresión GZIP</label>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="enable_cdn" name="settings[enable_cdn]" 
                                       {{ ($settings['advanced']['enable_cdn'] ?? false) ? 'checked' : '' }}>
                                <label for="enable_cdn">Usar CDN</label>
                            </div>
                        </div>
                        
                        <div class="danger-zone">
                            <h4>⚠️ Zona Peligrosa</h4>
                            <p>Estas acciones pueden afectar el funcionamiento del sistema. Procede con precaución.</p>
                            
                            <div style="display: flex; gap: 1rem;">
                                <button type="button" class="btn btn-danger" onclick="resetAllSettings()">🔄 Resetear Todo</button>
                                <button type="button" class="btn btn-danger" onclick="clearAllData()">🗑️ Limpiar Datos</button>
                            </div>
                        </div>
                    </div>

                    <!-- Barra de acciones -->
                    <div class="actions-bar">
                        <div class="actions-left">
                            <span id="last-saved">Última actualización: {{ date('d/m/Y H:i') }}</span>
                        </div>
                        <div class="actions-right">
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">Cancelar</button>
                            <button type="submit" class="btn btn-success">💾 Guardar Configuración</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Show specific settings section
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.settings-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Show selected section
            document.getElementById(sectionId + '-section').classList.add('active');
            
            // Update sidebar
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.classList.remove('active');
            });
            event.target.closest('.sidebar-item').classList.add('active');
        }

        // Form submission
        document.getElementById('settings-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            console.log('Saving settings:', Object.fromEntries(formData));
            
            // Show success message
            document.getElementById('success-message').style.display = 'block';
            document.getElementById('error-message').style.display = 'none';
            
            // Update last saved time
            document.getElementById('last-saved').textContent = 'Última actualización: ' + new Date().toLocaleString('es-ES');
            
            // Hide success message after 3 seconds
            setTimeout(() => {
                document.getElementById('success-message').style.display = 'none';
            }, 3000);
        });

        // Reset form
        function resetForm() {
            if (confirm('¿Estás seguro de que quieres descartar los cambios?')) {
                document.getElementById('settings-form').reset();
            }
        }

        // Catalog settings
        function resetCatalogSettings() {
            if (confirm('¿Restablecer configuración del catálogo a valores por defecto?')) {
                document.getElementById('products_per_page').value = '20';
                document.getElementById('default_sort').value = 'name';
                document.getElementById('show_eco_badges').checked = true;
                document.getElementById('show_safety_indicators').checked = true;
                alert('Configuración del catálogo restablecida');
            }
        }

        // Safety functions
        function runSafetyCheck() {
            alert('Ejecutando verificación de seguridad...');
            // Aquí harías una petición para verificar la seguridad
        }

        // Filter functions
        function addCustomFilter() {
            const filterName = prompt('Nombre del nuevo filtro:');
            if (filterName) {
                alert(`Filtro "${filterName}" agregado correctamente`);
            }
        }

        // Integration functions
        function testAllIntegrations() {
            alert('Probando todas las integraciones...');
            // Aquí harías peticiones para probar las integraciones
        }

        // Backup functions
        function createBackup() {
            if (confirm('¿Crear un nuevo backup del sistema?')) {
                alert('Creando backup...');
                // Aquí harías una petición para crear el backup
            }
        }

        function downloadBackup(type) {
            alert(`Descargando backup ${type}...`);
            // Aquí harías una petición para descargar el backup
        }

        function restoreBackup(type) {
            if (confirm(`¿Restaurar backup ${type}? Esta acción no se puede deshacer.`)) {
                alert(`Restaurando backup ${type}...`);
                // Aquí harías una petición para restaurar el backup
            }
        }

        // Advanced functions
        function clearAllCaches() {
            if (confirm('¿Limpiar todas las cachés del sistema?')) {
                alert('Limpiando cachés...');
                // Aquí harías una petición para limpiar las cachés
            }
        }

        function resetAllSettings() {
            if (confirm('¿Resetear TODA la configuración? Esta acción no se puede deshacer.')) {
                alert('Reseteando configuración...');
                // Aquí harías una petición para resetear todo
            }
        }

        function clearAllData() {
            const confirmation = prompt('Escribe "CONFIRMAR" para limpiar todos los datos:');
            if (confirmation === 'CONFIRMAR') {
                alert('Limpiando todos los datos...');
                // Aquí harías una petición para limpiar los datos
            }
        }
    </script>
</body>
</html>