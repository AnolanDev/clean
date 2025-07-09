<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Admin - Dashboard</title>
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
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #718096;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .stat-percentage {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-weight: 500;
        }
        
        .stat-percentage.good {
            background: #f0fff4;
            color: #22543d;
        }
        
        .stat-percentage.warning {
            background: #fffbeb;
            color: #744210;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .dashboard-section {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2d3748;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-block;
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
        
        .product-list {
            list-style: none;
        }
        
        .product-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .product-info h4 {
            margin-bottom: 0.25rem;
            color: #2d3748;
        }
        
        .product-info p {
            color: #718096;
            font-size: 0.9rem;
        }
        
        .product-badges {
            display: flex;
            gap: 0.5rem;
        }
        
        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .badge.eco {
            background: #f0fff4;
            color: #22543d;
        }
        
        .badge.safe {
            background: #e6fffa;
            color: #234e52;
        }
        
        .badge.warning {
            background: #fef5e7;
            color: #744210;
        }
        
        .badge.danger {
            background: #fed7d7;
            color: #742a2a;
        }
        
        .alerts {
            margin-bottom: 2rem;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        
        .alert.warning {
            background: #fef5e7;
            color: #744210;
            border-left: 4px solid #f6ad55;
        }
        
        .alert.info {
            background: #ebf8ff;
            color: #2c5282;
            border-left: 4px solid #4299e1;
        }
        
        .brand-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .brand-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .brand-count {
            background: #e2e8f0;
            color: #4a5568;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.8rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .quick-action {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            text-decoration: none;
            color: #4a5568;
            transition: all 0.2s;
        }
        
        .quick-action:hover {
            background: #edf2f7;
            transform: translateY(-2px);
        }
        
        .quick-action-icon {
            font-size: 1.5rem;
        }
        
        .quick-action-text {
            font-weight: 500;
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
                    <a href="{{ route('admin.clean.brands') }}">Marcas</a>
                    <a href="{{ route('admin.clean.categories') }}">Categorías</a>
                    <a href="{{ route('admin.clean.ingredients') }}">Ingredientes</a>
                    <a href="{{ route('admin.clean.safety') }}">Seguridad</a>
                    <a href="{{ route('admin.clean.analytics') }}">Análisis</a>
                    <a href="{{ route('admin.clean.settings') }}">Configuración</a>
                </nav>
            </div>
        </div>
    </header>

    <div class="container">
        @if(!empty($safetyAlerts))
            <div class="alerts">
                @foreach($safetyAlerts as $alert)
                    <div class="alert {{ $alert['type'] }}">
                        <strong>{{ $alert['message'] }}</strong>
                        <span style="float: right;">{{ $alert['action'] }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <div class="stat-number">{{ $statistics['total_products'] }}</div>
                <div class="stat-label">Total Productos</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">🌿</div>
                <div class="stat-number">{{ $statistics['eco_friendly_products'] }}</div>
                <div class="stat-label">Productos Ecológicos</div>
                <div class="stat-percentage good">{{ $statistics['eco_percentage'] }}%</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">🛡️</div>
                <div class="stat-number">{{ $statistics['safe_products'] }}</div>
                <div class="stat-label">Productos Seguros</div>
                <div class="stat-percentage good">{{ $statistics['safety_percentage'] }}%</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">⚠️</div>
                <div class="stat-number">{{ $statistics['hazardous_products'] }}</div>
                <div class="stat-label">Productos Peligrosos</div>
                <div class="stat-percentage warning">
                    {{ $statistics['total_products'] > 0 ? round(($statistics['hazardous_products'] / $statistics['total_products']) * 100, 1) : 0 }}%
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">🏷️</div>
                <div class="stat-number">{{ $statistics['total_brands'] }}</div>
                <div class="stat-label">Marcas</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">📂</div>
                <div class="stat-number">{{ $statistics['total_categories'] }}</div>
                <div class="stat-label">Categorías</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">🧪</div>
                <div class="stat-number">{{ $statistics['total_ingredients'] }}</div>
                <div class="stat-label">Ingredientes</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">☢️</div>
                <div class="stat-number">{{ $statistics['hazardous_ingredients'] }}</div>
                <div class="stat-label">Ingredientes Peligrosos</div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-section">
                <div class="section-header">
                    <h2 class="section-title">Productos Recientes</h2>
                    <a href="{{ route('admin.clean.products') }}" class="btn btn-primary">Ver todos</a>
                </div>
                
                <ul class="product-list">
                    @forelse($recentProducts as $product)
                        <li class="product-item">
                            <div class="product-info">
                                <h4>{{ $product->product->name ?? 'Producto #' . $product->id }}</h4>
                                <p>{{ $product->brand->name ?? 'Sin marca' }} - {{ $product->category->name ?? 'Sin categoría' }}</p>
                            </div>
                            <div class="product-badges">
                                @if($product->is_eco_friendly)
                                    <span class="badge eco">Ecológico</span>
                                @endif
                                @switch($product->safety_classification)
                                    @case('non_hazardous')
                                        <span class="badge safe">Seguro</span>
                                        @break
                                    @case('hazardous')
                                        <span class="badge danger">Peligroso</span>
                                        @break
                                    @default
                                        <span class="badge warning">{{ ucfirst($product->safety_classification) }}</span>
                                @endswitch
                            </div>
                        </li>
                    @empty
                        <li class="product-item">
                            <p>No hay productos recientes</p>
                        </li>
                    @endforelse
                </ul>
            </div>

            <div class="dashboard-section">
                <div class="section-header">
                    <h2 class="section-title">Marcas Populares</h2>
                    <a href="{{ route('admin.clean.brands') }}" class="btn btn-secondary">Ver todas</a>
                </div>
                
                <div class="brand-list">
                    @forelse($topBrands as $brand)
                        <div class="brand-item">
                            <div class="brand-info">
                                <strong>{{ $brand->name }}</strong>
                                @if($brand->is_eco_friendly)
                                    <span class="badge eco">Eco</span>
                                @endif
                            </div>
                            <div class="brand-count">{{ $brand->products_count }} productos</div>
                        </div>
                    @empty
                        <p>No hay marcas disponibles</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">Acciones Rápidas</h2>
            </div>
            
            <div class="quick-actions">
                <a href="{{ route('admin.clean.products') }}" class="quick-action">
                    <div class="quick-action-icon">📦</div>
                    <div class="quick-action-text">Gestionar Productos</div>
                </a>
                
                <a href="{{ route('admin.clean.safety') }}" class="quick-action">
                    <div class="quick-action-icon">🛡️</div>
                    <div class="quick-action-text">Reportes de Seguridad</div>
                </a>
                
                <a href="{{ route('admin.clean.analytics') }}" class="quick-action">
                    <div class="quick-action-icon">📊</div>
                    <div class="quick-action-text">Ver Análisis</div>
                </a>
                
                <a href="{{ route('admin.clean.settings') }}" class="quick-action">
                    <div class="quick-action-icon">⚙️</div>
                    <div class="quick-action-text">Configuración</div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>