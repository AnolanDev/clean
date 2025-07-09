<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Seguridad - Clean Admin</title>
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
        
        .safety-dashboard {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .safety-overview, .safety-alerts {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .section-header {
            background: #f7fafc;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .section-header h3 {
            color: #4a5568;
            font-size: 1.2rem;
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
        
        .btn-danger {
            background: #f56565;
            color: white;
        }
        
        .btn-danger:hover {
            background: #e53e3e;
        }
        
        .btn-warning {
            background: #ed8936;
            color: white;
        }
        
        .btn-warning:hover {
            background: #dd6b20;
        }
        
        .btn-success {
            background: #48bb78;
            color: white;
        }
        
        .btn-success:hover {
            background: #38a169;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            padding: 1rem;
        }
        
        .stat-card {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            border-left: 4px solid #e2e8f0;
        }
        
        .stat-card.danger {
            border-left-color: #f56565;
        }
        
        .stat-card.warning {
            border-left-color: #ed8936;
        }
        
        .stat-card.success {
            border-left-color: #48bb78;
        }
        
        .stat-card h4 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .stat-card.danger h4 {
            color: #f56565;
        }
        
        .stat-card.warning h4 {
            color: #ed8936;
        }
        
        .stat-card.success h4 {
            color: #48bb78;
        }
        
        .stat-card p {
            color: #4a5568;
            font-size: 0.9rem;
        }
        
        .alerts-list {
            padding: 1rem;
        }
        
        .alert-item {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            border-left: 4px solid;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .alert-item.danger {
            background: #fed7d7;
            border-left-color: #f56565;
        }
        
        .alert-item.warning {
            background: #fef5e7;
            border-left-color: #ed8936;
        }
        
        .alert-item.info {
            background: #e6fffa;
            border-left-color: #4fd1c7;
        }
        
        .alert-content {
            flex: 1;
        }
        
        .alert-content h4 {
            margin-bottom: 0.5rem;
            color: #2d3748;
        }
        
        .alert-content p {
            color: #4a5568;
            font-size: 0.9rem;
        }
        
        .alert-icon {
            font-size: 1.5rem;
            margin-right: 1rem;
        }
        
        .reports-section {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 2rem 0;
        }
        
        .reports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
            padding: 1rem;
        }
        
        .report-card {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        
        .report-card h4 {
            margin-bottom: 1rem;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .report-card p {
            color: #4a5568;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        
        .hazardous-products {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 2rem 0;
        }
        
        .products-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .products-table th,
        .products-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .products-table th {
            background: #f7fafc;
            font-weight: 600;
            color: #4a5568;
        }
        
        .product-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .product-icon {
            font-size: 1.5rem;
            width: 40px;
            height: 40px;
            background: #fed7d7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f56565;
        }
        
        .product-details h5 {
            margin-bottom: 0.25rem;
            color: #2d3748;
        }
        
        .product-details p {
            color: #718096;
            font-size: 0.9rem;
        }
        
        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-right: 0.5rem;
        }
        
        .badge.danger {
            background: #fed7d7;
            color: #742a2a;
        }
        
        .badge.warning {
            background: #fef5e7;
            color: #744210;
        }
        
        .badge.safe {
            background: #f0fff4;
            color: #22543d;
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
        
        .safety-chart {
            padding: 1rem;
            text-align: center;
        }
        
        .chart-placeholder {
            height: 200px;
            background: #f8fafc;
            border: 2px dashed #e2e8f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a0aec0;
            font-size: 1.1rem;
        }
        
        .actions-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: #f7fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .actions-left {
            display: flex;
            gap: 1rem;
        }
        
        .actions-right {
            display: flex;
            gap: 1rem;
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
        <div class="page-header">
            <h1 class="page-title">⚠️ Reportes de Seguridad</h1>
            <p>Monitorea y gestiona los aspectos de seguridad de productos e ingredientes</p>
        </div>

        <div class="safety-dashboard">
            <!-- Resumen de Seguridad -->
            <div class="safety-overview">
                <div class="section-header">
                    <h3>📊 Resumen de Seguridad</h3>
                    <a href="{{ route('admin.clean.safety.report') }}" class="btn btn-primary">📋 Generar Reporte</a>
                </div>

                <div class="stats-grid">
                    <div class="stat-card danger">
                        <h4>{{ $safetyStatistics['products']['hazardous'] ?? 0 }}</h4>
                        <p>Productos Peligrosos</p>
                    </div>
                    <div class="stat-card warning">
                        <h4>{{ $safetyStatistics['products']['moderate'] ?? 0 }}</h4>
                        <p>Riesgo Moderado</p>
                    </div>
                    <div class="stat-card success">
                        <h4>{{ $safetyStatistics['products']['safe'] ?? 0 }}</h4>
                        <p>Productos Seguros</p>
                    </div>
                    <div class="stat-card danger">
                        <h4>{{ $safetyStatistics['ingredients']['hazardous'] ?? 0 }}</h4>
                        <p>Ingredientes Peligrosos</p>
                    </div>
                </div>

                <div class="safety-chart">
                    <h4>Distribución de Niveles de Seguridad</h4>
                    <div class="chart-placeholder">
                        📈 Gráfico de distribución de seguridad
                    </div>
                </div>
            </div>

            <!-- Alertas de Seguridad -->
            <div class="safety-alerts">
                <div class="section-header">
                    <h3>🚨 Alertas de Seguridad</h3>
                    <button class="btn btn-warning" onclick="refreshAlerts()">🔄 Actualizar</button>
                </div>

                <div class="alerts-list">
                    @if(count($reports) > 0)
                        @foreach($reports as $alert)
                            <div class="alert-item {{ $alert['type'] ?? 'info' }}">
                                <div class="alert-icon">
                                    @switch($alert['type'] ?? 'info')
                                        @case('danger') 🚨 @break
                                        @case('warning') ⚠️ @break
                                        @default ℹ️
                                    @endswitch
                                </div>
                                <div class="alert-content">
                                    <h4>{{ $alert['title'] ?? 'Alerta de Seguridad' }}</h4>
                                    <p>{{ $alert['message'] ?? 'Información no disponible' }}</p>
                                </div>
                                <button class="btn btn-primary" onclick="viewAlert({{ $loop->index }})">Ver</button>
                            </div>
                        @endforeach
                    @else
                        <div class="no-data">
                            <h3>✅ No hay alertas activas</h3>
                            <p>Todos los sistemas están funcionando correctamente.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Reportes Disponibles -->
        <div class="reports-section">
            <div class="section-header">
                <h3>📋 Reportes Disponibles</h3>
                <button class="btn btn-success" onclick="generateCustomReport()">📊 Reporte Personalizado</button>
            </div>

            <div class="reports-grid">
                <div class="report-card">
                    <h4>⚠️ Reporte de Productos Peligrosos</h4>
                    <p>Lista completa de productos con clasificación de alto riesgo y sus componentes peligrosos.</p>
                    <button class="btn btn-danger" onclick="generateReport('hazardous-products')">Generar PDF</button>
                </div>

                <div class="report-card">
                    <h4>🧪 Análisis de Ingredientes</h4>
                    <p>Evaluación detallada de ingredientes por nivel de seguridad y frecuencia de uso.</p>
                    <button class="btn btn-warning" onclick="generateReport('ingredients-analysis')">Generar PDF</button>
                </div>

                <div class="report-card">
                    <h4>📊 Estadísticas de Cumplimiento</h4>
                    <p>Métricas de cumplimiento de normativas de seguridad y regulaciones ambientales.</p>
                    <button class="btn btn-primary" onclick="generateReport('compliance-stats')">Generar PDF</button>
                </div>

                <div class="report-card">
                    <h4>🔍 Auditoría de Seguridad</h4>
                    <p>Revisión completa de procesos de seguridad y recomendaciones de mejora.</p>
                    <button class="btn btn-success" onclick="generateReport('security-audit')">Generar PDF</button>
                </div>

                <div class="report-card">
                    <h4>📈 Tendencias de Seguridad</h4>
                    <p>Análisis de tendencias temporales en clasificaciones de seguridad y incidencias.</p>
                    <button class="btn btn-primary" onclick="generateReport('safety-trends')">Generar PDF</button>
                </div>

                <div class="report-card">
                    <h4>🌿 Reporte Eco-Seguridad</h4>
                    <p>Evaluación combinada de impacto ambiental y seguridad de productos.</p>
                    <button class="btn btn-success" onclick="generateReport('eco-safety')">Generar PDF</button>
                </div>
            </div>
        </div>

        <!-- Productos Peligrosos -->
        <div class="hazardous-products">
            <div class="section-header">
                <h3>☠️ Productos Peligrosos</h3>
                <div class="actions-right">
                    <button class="btn btn-warning" onclick="exportHazardous()">📥 Exportar</button>
                    <button class="btn btn-danger" onclick="reviewHazardous()">🔍 Revisar</button>
                </div>
            </div>

            @if($hazardousProducts->count() > 0)
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Marca</th>
                            <th>Categoría</th>
                            <th>Nivel de Riesgo</th>
                            <th>Ingredientes Peligrosos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hazardousProducts as $product)
                            <tr>
                                <td>
                                    <div class="product-info">
                                        <div class="product-icon">☠️</div>
                                        <div class="product-details">
                                            <h5>{{ $product->product->name ?? 'Producto #' . $product->id }}</h5>
                                            <p>ID: {{ $product->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->brand->name ?? 'Sin marca' }}</td>
                                <td>{{ $product->category->name ?? 'Sin categoría' }}</td>
                                <td>
                                    @switch($product->safety_classification)
                                        @case('hazardous')
                                            <span class="badge danger">☠️ Peligroso</span>
                                            @break
                                        @case('corrosive')
                                            <span class="badge danger">🔥 Corrosivo</span>
                                            @break
                                        @case('toxic')
                                            <span class="badge danger">☠️ Tóxico</span>
                                            @break
                                        @default
                                            <span class="badge warning">⚠️ {{ ucfirst($product->safety_classification) }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    <span class="badge warning">{{ $product->ingredients_count ?? 0 }} ingredientes</span>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <button class="btn btn-primary" onclick="viewProduct({{ $product->id }})">👁️</button>
                                        <button class="btn btn-warning" onclick="reviewSafety({{ $product->id }})">🔍</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no-data">
                    <h3>✅ No hay productos peligrosos registrados</h3>
                    <p>Excelente! Todos los productos cumplen con los estándares de seguridad.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Refresh alerts
        function refreshAlerts() {
            console.log('Refreshing safety alerts...');
            // Aquí harías una petición AJAX para actualizar alertas
            alert('Alertas actualizadas correctamente');
        }

        // View alert details
        function viewAlert(index) {
            console.log('Viewing alert:', index);
            // Aquí mostrarías un modal con detalles de la alerta
            alert(`Viendo detalles de la alerta ${index + 1}`);
        }

        // Generate report
        function generateReport(type) {
            console.log('Generating report:', type);
            // Aquí harías una petición para generar el reporte
            alert(`Generando reporte: ${type}`);
        }

        // Generate custom report
        function generateCustomReport() {
            console.log('Generating custom report...');
            // Aquí mostrarías un modal para configurar reporte personalizado
            alert('Configurando reporte personalizado...');
        }

        // Export hazardous products
        function exportHazardous() {
            console.log('Exporting hazardous products...');
            // Aquí harías una petición para exportar productos peligrosos
            alert('Exportando productos peligrosos...');
        }

        // Review hazardous products
        function reviewHazardous() {
            console.log('Reviewing hazardous products...');
            // Aquí iniciarías el proceso de revisión
            alert('Iniciando revisión de productos peligrosos...');
        }

        // View product details
        function viewProduct(productId) {
            console.log('Viewing product:', productId);
            // Aquí mostrarías detalles del producto
            alert(`Viendo producto ID: ${productId}`);
        }

        // Review product safety
        function reviewSafety(productId) {
            console.log('Reviewing safety for product:', productId);
            // Aquí iniciarías revisión de seguridad
            alert(`Revisando seguridad del producto ID: ${productId}`);
        }
    </script>
</body>
</html>