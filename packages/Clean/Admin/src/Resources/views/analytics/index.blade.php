<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - Clean Admin</title>
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
        
        .analytics-controls {
            background: white;
            padding: 1.5rem;
            margin: 2rem 0;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .controls-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            align-items: end;
        }
        
        .control-group {
            display: flex;
            flex-direction: column;
        }
        
        .control-group label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #4a5568;
        }
        
        .control-group select,
        .control-group input {
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            font-size: 0.9rem;
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
        
        .main-dashboard {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .metrics-section {
            display: grid;
            gap: 2rem;
        }
        
        .metrics-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .card-header {
            background: #f7fafc;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-header h3 {
            color: #4a5568;
            font-size: 1.2rem;
        }
        
        .card-content {
            padding: 1.5rem;
        }
        
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .kpi-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
        }
        
        .kpi-card h4 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .kpi-card p {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .kpi-card .trend {
            font-size: 0.8rem;
            margin-top: 0.5rem;
            opacity: 0.8;
        }
        
        .chart-container {
            height: 300px;
            background: #f8fafc;
            border: 2px dashed #e2e8f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a0aec0;
            font-size: 1.1rem;
            margin: 1rem 0;
        }
        
        .insights-sidebar {
            display: grid;
            gap: 2rem;
        }
        
        .insight-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .insight-item {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .insight-item:last-child {
            border-bottom: none;
        }
        
        .insight-icon {
            font-size: 1.5rem;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .insight-icon.eco {
            background: #f0fff4;
            color: #22543d;
        }
        
        .insight-icon.safety {
            background: #fef5e7;
            color: #744210;
        }
        
        .insight-icon.trend {
            background: #e6fffa;
            color: #234e52;
        }
        
        .insight-icon.performance {
            background: #faf5ff;
            color: #553c9a;
        }
        
        .insight-content {
            flex: 1;
        }
        
        .insight-content h4 {
            margin-bottom: 0.25rem;
            color: #2d3748;
        }
        
        .insight-content p {
            color: #4a5568;
            font-size: 0.9rem;
        }
        
        .insight-value {
            font-size: 1.2rem;
            font-weight: 600;
            color: #667eea;
        }
        
        .trends-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .trend-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .trend-header {
            background: #f7fafc;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .trend-header h4 {
            color: #4a5568;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .trend-content {
            padding: 1.5rem;
        }
        
        .trend-metric {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .trend-metric:last-child {
            margin-bottom: 0;
        }
        
        .trend-label {
            color: #4a5568;
        }
        
        .trend-value {
            font-weight: 600;
            color: #2d3748;
        }
        
        .trend-growth {
            font-size: 0.9rem;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            margin-left: 0.5rem;
        }
        
        .trend-growth.positive {
            background: #f0fff4;
            color: #22543d;
        }
        
        .trend-growth.negative {
            background: #fed7d7;
            color: #742a2a;
        }
        
        .performance-section {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 2rem 0;
        }
        
        .performance-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .performance-table th,
        .performance-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .performance-table th {
            background: #f7fafc;
            font-weight: 600;
            color: #4a5568;
        }
        
        .brand-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .brand-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .brand-details h5 {
            margin-bottom: 0.25rem;
            color: #2d3748;
        }
        
        .brand-details p {
            color: #4a5568;
            font-size: 0.9rem;
        }
        
        .performance-bar {
            width: 100px;
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .performance-fill {
            height: 100%;
            background: linear-gradient(90deg, #48bb78, #38a169);
            transition: width 0.3s ease;
        }
        
        .export-section {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin: 2rem 0;
        }
        
        .export-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }
        
        .export-option {
            padding: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .export-option:hover {
            border-color: #667eea;
            background: #f8fafc;
        }
        
        .export-option h4 {
            margin-bottom: 0.5rem;
            color: #2d3748;
        }
        
        .export-option p {
            color: #4a5568;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .no-data {
            text-align: center;
            padding: 3rem;
            color: #a0aec0;
        }
        
        .no-data h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
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
            <h1 class="page-title">📊 Analytics y Métricas</h1>
            <p>Análisis avanzado de datos de productos, marcas y tendencias del mercado</p>
        </div>

        <!-- Controles de Filtros -->
        <div class="analytics-controls">
            <div class="controls-grid">
                <div class="control-group">
                    <label>Período</label>
                    <select id="period-filter">
                        <option value="7d">Últimos 7 días</option>
                        <option value="30d" selected>Últimos 30 días</option>
                        <option value="90d">Últimos 90 días</option>
                        <option value="1y">Último año</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label>Categoría</label>
                    <select id="category-filter">
                        <option value="">Todas las categorías</option>
                        <option value="detergents">Detergentes</option>
                        <option value="disinfectants">Desinfectantes</option>
                        <option value="surface-cleaners">Limpiadores de superficie</option>
                        <option value="personal-care">Cuidado personal</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label>Métrica</label>
                    <select id="metric-filter">
                        <option value="sales">Ventas</option>
                        <option value="views">Visualizaciones</option>
                        <option value="searches">Búsquedas</option>
                        <option value="eco-score">Score Ecológico</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <button class="btn btn-primary" onclick="updateAnalytics()">🔄 Actualizar</button>
                </div>
            </div>
        </div>

        <!-- KPIs Principales -->
        <div class="kpi-grid">
            <div class="kpi-card">
                <h4>{{ $analytics['product_views'] ?? 0 }}</h4>
                <p>Visualizaciones de Productos</p>
                <div class="trend">+15% vs mes anterior</div>
            </div>
            
            <div class="kpi-card">
                <h4>{{ $analytics['search_queries'] ?? 0 }}</h4>
                <p>Búsquedas Realizadas</p>
                <div class="trend">+8% vs mes anterior</div>
            </div>
            
            <div class="kpi-card">
                <h4>{{ count($analytics['popular_categories'] ?? []) }}</h4>
                <p>Categorías Populares</p>
                <div class="trend">+3% vs mes anterior</div>
            </div>
            
            <div class="kpi-card">
                <h4>{{ $analytics['eco_trend']['current_month'] ?? 0 }}</h4>
                <p>Productos Eco-Friendly</p>
                <div class="trend">{{ $analytics['eco_trend']['growth_rate'] ?? '+0%' }}</div>
            </div>
        </div>

        <!-- Dashboard Principal -->
        <div class="main-dashboard">
            <div class="metrics-section">
                <!-- Gráfico de Tendencias -->
                <div class="metrics-card">
                    <div class="card-header">
                        <h3>📈 Tendencias de Productos</h3>
                        <select id="trend-metric">
                            <option value="views">Visualizaciones</option>
                            <option value="searches">Búsquedas</option>
                            <option value="eco-score">Score Ecológico</option>
                        </select>
                    </div>
                    <div class="card-content">
                        <div class="chart-container">
                            📊 Gráfico de tendencias temporales
                        </div>
                    </div>
                </div>

                <!-- Análisis de Categorías -->
                <div class="metrics-card">
                    <div class="card-header">
                        <h3>📁 Análisis por Categorías</h3>
                        <button class="btn btn-secondary" onclick="exportCategoryData()">📥 Exportar</button>
                    </div>
                    <div class="card-content">
                        <div class="chart-container">
                            🥧 Gráfico de distribución por categorías
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar de Insights -->
            <div class="insights-sidebar">
                <!-- Insights Clave -->
                <div class="insight-card">
                    <div class="card-header">
                        <h3>💡 Insights Clave</h3>
                    </div>
                    
                    <div class="insight-item">
                        <div class="insight-icon eco">🌿</div>
                        <div class="insight-content">
                            <h4>Tendencia Ecológica</h4>
                            <p>Los productos eco-friendly han crecido un 15% este mes</p>
                        </div>
                    </div>
                    
                    <div class="insight-item">
                        <div class="insight-icon safety">⚠️</div>
                        <div class="insight-content">
                            <h4>Seguridad</h4>
                            <p>85% de productos cumplen estándares de seguridad</p>
                        </div>
                    </div>
                    
                    <div class="insight-item">
                        <div class="insight-icon trend">📊</div>
                        <div class="insight-content">
                            <h4>Categoría Trending</h4>
                            <p>Desinfectantes lideran en búsquedas</p>
                        </div>
                    </div>
                    
                    <div class="insight-item">
                        <div class="insight-icon performance">🚀</div>
                        <div class="insight-content">
                            <h4>Performance</h4>
                            <p>Tiempo de respuesta mejorado en 25%</p>
                        </div>
                    </div>
                </div>

                <!-- Alertas y Recomendaciones -->
                <div class="insight-card">
                    <div class="card-header">
                        <h3>🔔 Recomendaciones</h3>
                    </div>
                    
                    <div class="insight-item">
                        <div class="insight-content">
                            <h4>Optimización SEO</h4>
                            <p>Mejorar descripciones en 23 productos</p>
                        </div>
                        <div class="insight-value">23</div>
                    </div>
                    
                    <div class="insight-item">
                        <div class="insight-content">
                            <h4>Stock Crítico</h4>
                            <p>5 productos necesitan restock</p>
                        </div>
                        <div class="insight-value">5</div>
                    </div>
                    
                    <div class="insight-item">
                        <div class="insight-content">
                            <h4>Nuevas Oportunidades</h4>
                            <p>Categoría "Limpieza Solar" en auge</p>
                        </div>
                        <div class="insight-value">↗️</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Tendencias -->
        <div class="trends-section">
            <div class="trend-card">
                <div class="trend-header">
                    <h4>🌿 Tendencias Ecológicas</h4>
                </div>
                <div class="trend-content">
                    <div class="trend-metric">
                        <span class="trend-label">Productos Eco-Friendly</span>
                        <span class="trend-value">{{ $productTrends['eco_products']['current'] ?? 0 }}</span>
                        <span class="trend-growth positive">{{ $productTrends['eco_products']['growth'] ?? '+0%' }}</span>
                    </div>
                    <div class="trend-metric">
                        <span class="trend-label">Certificaciones Verdes</span>
                        <span class="trend-value">45</span>
                        <span class="trend-growth positive">+12%</span>
                    </div>
                    <div class="trend-metric">
                        <span class="trend-label">Biodegradables</span>
                        <span class="trend-value">78</span>
                        <span class="trend-growth positive">+8%</span>
                    </div>
                </div>
            </div>

            <div class="trend-card">
                <div class="trend-header">
                    <h4>🛡️ Tendencias de Seguridad</h4>
                </div>
                <div class="trend-content">
                    <div class="trend-metric">
                        <span class="trend-label">Productos Seguros</span>
                        <span class="trend-value">{{ $productTrends['safe_products']['current'] ?? 0 }}</span>
                        <span class="trend-growth positive">{{ $productTrends['safe_products']['growth'] ?? '+0%' }}</span>
                    </div>
                    <div class="trend-metric">
                        <span class="trend-label">Clasificaciones Revisadas</span>
                        <span class="trend-value">156</span>
                        <span class="trend-growth positive">+25%</span>
                    </div>
                    <div class="trend-metric">
                        <span class="trend-label">Alertas Resueltas</span>
                        <span class="trend-value">89</span>
                        <span class="trend-growth positive">+18%</span>
                    </div>
                </div>
            </div>

            <div class="trend-card">
                <div class="trend-header">
                    <h4>📦 Tendencias de Productos</h4>
                </div>
                <div class="trend-content">
                    <div class="trend-metric">
                        <span class="trend-label">Nuevos Productos</span>
                        <span class="trend-value">{{ $productTrends['new_products']['current'] ?? 0 }}</span>
                        <span class="trend-growth positive">{{ $productTrends['new_products']['growth'] ?? '+0%' }}</span>
                    </div>
                    <div class="trend-metric">
                        <span class="trend-label">Productos Actualizados</span>
                        <span class="trend-value">234</span>
                        <span class="trend-growth positive">+15%</span>
                    </div>
                    <div class="trend-metric">
                        <span class="trend-label">Revisiones Pendientes</span>
                        <span class="trend-value">12</span>
                        <span class="trend-growth negative">-22%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance de Marcas -->
        <div class="performance-section">
            <div class="card-header">
                <h3>🏆 Performance de Marcas</h3>
                <button class="btn btn-secondary" onclick="exportBrandData()">📊 Reporte Completo</button>
            </div>
            
            @if($brandPerformance && $brandPerformance->count() > 0)
                <table class="performance-table">
                    <thead>
                        <tr>
                            <th>Marca</th>
                            <th>Productos</th>
                            <th>Visualizaciones</th>
                            <th>Performance</th>
                            <th>Tendencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brandPerformance as $brand)
                            <tr>
                                <td>
                                    <div class="brand-info">
                                        <div class="brand-avatar">
                                            {{ strtoupper(substr($brand->name, 0, 2)) }}
                                        </div>
                                        <div class="brand-details">
                                            <h5>{{ $brand->name }}</h5>
                                            <p>{{ $brand->country ?? 'Global' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $brand->products_count ?? 0 }}</td>
                                <td>{{ rand(1000, 9999) }}</td>
                                <td>
                                    <div class="performance-bar">
                                        <div class="performance-fill" style="width: {{ rand(30, 95) }}%"></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="trend-growth positive">+{{ rand(5, 25) }}%</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no-data">
                    <h3>📊 No hay datos de performance disponibles</h3>
                    <p>Los datos se actualizarán automáticamente cuando haya suficiente información.</p>
                </div>
            @endif
        </div>

        <!-- Opciones de Exportación -->
        <div class="export-section">
            <h3>📥 Exportar Datos</h3>
            <div class="export-grid">
                <div class="export-option" onclick="exportData('products')">
                    <h4>📦 Reporte de Productos</h4>
                    <p>Análisis completo de productos con métricas y tendencias</p>
                    <button class="btn btn-primary">Exportar PDF</button>
                </div>
                
                <div class="export-option" onclick="exportData('brands')">
                    <h4>🏷️ Performance de Marcas</h4>
                    <p>Estadísticas detalladas de rendimiento por marca</p>
                    <button class="btn btn-primary">Exportar Excel</button>
                </div>
                
                <div class="export-option" onclick="exportData('categories')">
                    <h4>📁 Análisis de Categorías</h4>
                    <p>Distribución y tendencias por categoría de productos</p>
                    <button class="btn btn-primary">Exportar CSV</button>
                </div>
                
                <div class="export-option" onclick="exportData('eco-trends')">
                    <h4>🌿 Tendencias Ecológicas</h4>
                    <p>Análisis de sostenibilidad y productos eco-friendly</p>
                    <button class="btn btn-success">Exportar PDF</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update analytics based on filters
        function updateAnalytics() {
            const period = document.getElementById('period-filter').value;
            const category = document.getElementById('category-filter').value;
            const metric = document.getElementById('metric-filter').value;
            
            console.log('Updating analytics:', { period, category, metric });
            // Aquí harías una petición AJAX para actualizar los datos
            alert('Actualizando analytics...');
        }

        // Export specific data type
        function exportData(type) {
            console.log('Exporting data:', type);
            // Aquí harías una petición para exportar los datos
            alert(`Exportando datos de ${type}...`);
        }

        // Export category data
        function exportCategoryData() {
            console.log('Exporting category data...');
            alert('Exportando datos de categorías...');
        }

        // Export brand data
        function exportBrandData() {
            console.log('Exporting brand data...');
            alert('Exportando datos de marcas...');
        }

        // Initialize charts (placeholder)
        function initializeCharts() {
            // Aquí inicializarías librerías como Chart.js o D3.js
            console.log('Initializing charts...');
        }

        // Auto-refresh data every 5 minutes
        setInterval(function() {
            console.log('Auto-refreshing analytics data...');
            // Aquí harías una petición automática para actualizar datos
        }, 300000); // 5 minutos

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initializeCharts();
        });
    </script>
</body>
</html>