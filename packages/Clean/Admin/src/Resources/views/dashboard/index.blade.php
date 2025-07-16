<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Clean Admin</title>
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
        
        .nav-links a:hover,
        .nav-links a.active {
            background-color: rgba(255,255,255,0.2);
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
        
        .stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid #667eea;
            transition: transform 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
        }
        
        .stat-card.products {
            border-left-color: #667eea;
        }
        
        .stat-card.brands {
            border-left-color: #48bb78;
        }
        
        .stat-card.categories {
            border-left-color: #ed8936;
        }
        
        .stat-card.ingredients {
            border-left-color: #9f7aea;
        }
        
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        .stat-icon {
            font-size: 2rem;
            opacity: 0.7;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #4a5568;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .stat-details {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #718096;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .main-content {
            display: grid;
            gap: 2rem;
        }
        
        .sidebar-content {
            display: grid;
            gap: 1.5rem;
        }
        
        .card {
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
            justify-content: between;
            align-items: center;
        }
        
        .card-header h3 {
            color: #4a5568;
            font-size: 1.2rem;
        }
        
        .card-content {
            padding: 1.5rem;
        }
        
        .chart-placeholder {
            height: 300px;
            background: #f8fafc;
            border: 2px dashed #e2e8f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a0aec0;
            font-size: 1.1rem;
        }
        
        .top-brands-list {
            display: grid;
            gap: 1rem;
        }
        
        .brand-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 8px;
            border-left: 3px solid #667eea;
        }
        
        .brand-name {
            font-weight: 500;
            color: #2d3748;
        }
        
        .brand-count {
            background: #667eea;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .category-list {
            display: grid;
            gap: 0.75rem;
        }
        
        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .category-item:last-child {
            border-bottom: none;
        }
        
        .category-name {
            color: #4a5568;
            font-size: 0.9rem;
        }
        
        .category-count {
            color: #667eea;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }
        
        .metric-item {
            padding: 1rem;
            background: #f8fafc;
            border-radius: 8px;
            text-align: center;
        }
        
        .metric-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.25rem;
        }
        
        .metric-label {
            color: #4a5568;
            font-size: 0.9rem;
        }
        
        .metric-percentage {
            font-size: 0.8rem;
            color: #48bb78;
            margin-top: 0.25rem;
        }
        
        .safety-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin: 1rem 0;
        }
        
        .safety-item {
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }
        
        .safety-item.safe {
            background: #f0fff4;
            color: #22543d;
        }
        
        .safety-item.moderate {
            background: #fef5e7;
            color: #744210;
        }
        
        .safety-item.hazardous {
            background: #fed7d7;
            color: #742a2a;
        }
        
        .safety-count {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .safety-label {
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
        
        .refresh-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            transition: all 0.2s;
        }
        
        .refresh-btn:hover {
            background: #5a6fd8;
            transform: scale(1.1);
        }
        
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }
        
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-links {
                display: none;
            }
            
            .stats-overview {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 480px) {
            .stats-overview {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('clean-admin::partials.header')
    @include('clean-admin::partials.sidebar')

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">📊 Dashboard</h1>
            <p>Vista general del sistema de gestión de productos de limpieza</p>
        </div>

        <!-- Estadísticas Principales -->
        <div class="stats-overview">
            <div class="stat-card products">
                <div class="stat-header">
                    <div>
                        <div class="stat-number">{{ $totalProducts }}</div>
                        <div class="stat-label">Productos Totales</div>
                    </div>
                    <div class="stat-icon">📦</div>
                </div>
                <div class="stat-details">
                    <span>Eco-friendly: {{ $ecoPercentage }}%</span>
                    <span>Biodegradables: {{ $biodegradablePercentage }}%</span>
                </div>
            </div>

            <div class="stat-card brands">
                <div class="stat-header">
                    <div>
                        <div class="stat-number">{{ $totalBrands }}</div>
                        <div class="stat-label">Marcas Registradas</div>
                    </div>
                    <div class="stat-icon">🏷️</div>
                </div>
                <div class="stat-details">
                    <span>Eco-friendly: {{ $ecoFriendlyBrandsPercentage }}%</span>
                    <span>Activas: {{ $totalBrands }}</span>
                </div>
            </div>

            <div class="stat-card categories">
                <div class="stat-header">
                    <div>
                        <div class="stat-number">{{ $totalCategories }}</div>
                        <div class="stat-label">Categorías</div>
                    </div>
                    <div class="stat-icon">📁</div>
                </div>
                <div class="stat-details">
                    <span>Principales: {{ $productsByCategory->count() }}</span>
                    <span>Subcategorías: {{ $totalCategories - $productsByCategory->count() }}</span>
                </div>
            </div>

            <div class="stat-card ingredients">
                <div class="stat-header">
                    <div>
                        <div class="stat-number">{{ $totalIngredients }}</div>
                        <div class="stat-label">Ingredientes</div>
                    </div>
                    <div class="stat-icon">🧪</div>
                </div>
                <div class="stat-details">
                    <span>Naturales: {{ $ingredientsByType->where('type', 'natural')->sum('count') ?? 0 }}</span>
                    <span>Seguros: {{ $ingredientsSafety->where('safety_level', 'low')->sum('count') ?? 0 }}</span>
                </div>
            </div>
        </div>

        <!-- Dashboard Principal -->
        <div class="dashboard-grid">
            <div class="main-content">
                <!-- Productos por Categoría -->
                <div class="card">
                    <div class="card-header">
                        <h3>📊 Productos por Categoría Principal</h3>
                    </div>
                    <div class="card-content">
                        @if($productsByCategory->count() > 0)
                            <div class="category-list">
                                @foreach($productsByCategory as $category)
                                    <div class="category-item">
                                        <span class="category-name">{{ $category->name }}</span>
                                        <span class="category-count">{{ $category->products_count }} productos</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="chart-placeholder">
                                📊 No hay datos de categorías disponibles
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Métricas de Productos -->
                <div class="card">
                    <div class="card-header">
                        <h3>🧪 Análisis de Productos</h3>
                    </div>
                    <div class="card-content">
                        <div class="metrics-grid">
                            <div class="metric-item">
                                <div class="metric-value">{{ $ecoProducts }}</div>
                                <div class="metric-label">Eco-Friendly</div>
                                <div class="metric-percentage">{{ $ecoPercentage }}% del total</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-value">{{ $biodegradableProducts }}</div>
                                <div class="metric-label">Biodegradables</div>
                                <div class="metric-percentage">{{ $biodegradablePercentage }}% del total</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-value">{{ $concentratedProducts }}</div>
                                <div class="metric-label">Concentrados</div>
                                <div class="metric-percentage">{{ $concentratedPercentage }}% del total</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-value">{{ $antibacterialProducts }}</div>
                                <div class="metric-label">Antibacteriales</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-value">{{ $antiviralProducts }}</div>
                                <div class="metric-label">Antivirales</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estadísticas de Seguridad -->
                <div class="card">
                    <div class="card-header">
                        <h3>🛡️ Clasificación de Seguridad</h3>
                    </div>
                    <div class="card-content">
                        <div class="safety-stats">
                            <div class="safety-item safe">
                                <div class="safety-count">{{ $safetyStats['safe'] }}</div>
                                <div class="safety-label">Seguros</div>
                            </div>
                            <div class="safety-item moderate">
                                <div class="safety-count">{{ $safetyStats['moderate'] }}</div>
                                <div class="safety-label">Moderados</div>
                            </div>
                            <div class="safety-item hazardous">
                                <div class="safety-count">{{ $safetyStats['hazardous'] }}</div>
                                <div class="safety-label">Peligrosos</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar-content">
                <!-- Top Marcas -->
                <div class="card">
                    <div class="card-header">
                        <h3>🏆 Top Marcas</h3>
                    </div>
                    <div class="card-content">
                        @if($topBrands->count() > 0)
                            <div class="top-brands-list">
                                @foreach($topBrands->take(5) as $brand)
                                    <div class="brand-item">
                                        <span class="brand-name">{{ $brand->name }}</span>
                                        <span class="brand-count">{{ $brand->products_count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>No hay marcas disponibles</p>
                        @endif
                    </div>
                </div>

                <!-- Categorías Activas -->
                <div class="card">
                    <div class="card-header">
                        <h3>📂 Categorías con Productos</h3>
                    </div>
                    <div class="card-content">
                        @if($categoriesWithProducts->count() > 0)
                            <div class="category-list">
                                @foreach($categoriesWithProducts->take(6) as $category)
                                    <div class="category-item">
                                        <span class="category-name">{{ $category->name }}</span>
                                        <span class="category-count">{{ $category->products_count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>No hay categorías con productos</p>
                        @endif
                    </div>
                </div>

                <!-- Ingredientes por Tipo -->
                <div class="card">
                    <div class="card-header">
                        <h3>🧪 Ingredientes por Tipo</h3>
                    </div>
                    <div class="card-content">
                        @if($ingredientsByType->count() > 0)
                            <div class="category-list">
                                @foreach($ingredientsByType as $ingredient)
                                    <div class="category-item">
                                        <span class="category-name">{{ ucfirst($ingredient->type) }}</span>
                                        <span class="category-count">{{ $ingredient->count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>No hay ingredientes registrados</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón de Actualización -->
    <button class="refresh-btn" onclick="refreshDashboard()" title="Actualizar Dashboard">
        🔄
    </button>

    <script>
        // Función para actualizar el dashboard
        function refreshDashboard() {
            const refreshBtn = document.querySelector('.refresh-btn');
            refreshBtn.style.transform = 'rotate(360deg)';
            
            // Simular recarga de datos
            setTimeout(() => {
                location.reload();
            }, 500);
        }

        // Auto-refresh cada 5 minutos
        setInterval(function() {
            console.log('Auto-refreshing dashboard...');
            // Aquí harías una petición AJAX para actualizar los datos sin recargar la página
        }, 300000); // 5 minutos

        // Función para obtener estadísticas via AJAX
        function getStats(type) {
            fetch(`{{ route('admin.clean.dashboard.stats') }}?type=${type}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Stats data:', data);
                    // Actualizar elementos específicos sin recargar la página
                })
                .catch(error => console.error('Error:', error));
        }

        // Inicializar dashboard
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Dashboard loaded with {{ $totalProducts }} products');
        });
    </script>
</body>
</html>