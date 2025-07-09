<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Marcas - Clean Admin</title>
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
        
        .filters {
            background: white;
            padding: 1.5rem;
            margin: 2rem 0;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .filters h3 {
            margin-bottom: 1rem;
            color: #4a5568;
        }
        
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
        }
        
        .filter-group label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #4a5568;
        }
        
        .filter-group select,
        .filter-group input {
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
        
        .btn-danger {
            background: #f56565;
            color: white;
        }
        
        .btn-danger:hover {
            background: #e53e3e;
        }
        
        .brands-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 2rem 0;
        }
        
        .table-header {
            background: #f7fafc;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .table-actions {
            display: flex;
            gap: 1rem;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        
        th {
            background: #f7fafc;
            font-weight: 600;
            color: #4a5568;
        }
        
        .brand-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .brand-icon {
            font-size: 2.5rem;
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #f7fafc, #edf2f7);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #e2e8f0;
        }
        
        .brand-details h4 {
            margin-bottom: 0.25rem;
            color: #2d3748;
            font-size: 1.1rem;
        }
        
        .brand-details p {
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
        
        .badge.eco {
            background: #f0fff4;
            color: #22543d;
        }
        
        .badge.premium {
            background: #faf5ff;
            color: #553c9a;
        }
        
        .badge.popular {
            background: #fff5f5;
            color: #742a2a;
        }
        
        .actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin: 2rem 0;
        }
        
        .pagination a {
            padding: 0.5rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            text-decoration: none;
            color: #4a5568;
            transition: all 0.2s;
        }
        
        .pagination a:hover {
            background: #f7fafc;
        }
        
        .pagination .active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .no-brands {
            text-align: center;
            padding: 3rem;
            color: #a0aec0;
        }
        
        .no-brands h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .stat-card {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }
        
        .stat-card h4 {
            font-size: 1.5rem;
            color: #667eea;
            margin-bottom: 0.5rem;
        }
        
        .stat-card p {
            color: #4a5568;
            font-size: 0.9rem;
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
            <h1 class="page-title">🏷️ Gestión de Marcas</h1>
            <p>Administra todas las marcas de productos de limpieza</p>
        </div>

        <div class="filters">
            <h3>🔍 Filtros</h3>
            <form method="GET" action="{{ route('admin.clean.brands') }}">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label>Búsqueda</label>
                        <input type="text" name="search" placeholder="Buscar marcas..." value="{{ request('search') }}">
                    </div>
                    
                    <div class="filter-group">
                        <label>Tipo</label>
                        <select name="eco_friendly">
                            <option value="">Todas las marcas</option>
                            <option value="1" {{ request('eco_friendly') == '1' ? 'selected' : '' }}>Eco-friendly</option>
                            <option value="0" {{ request('eco_friendly') == '0' ? 'selected' : '' }}>Convencionales</option>
                        </select>
                    </div>
                </div>
                
                <div style="margin-top: 1rem;">
                    <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                    <a href="{{ route('admin.clean.brands') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </form>
        </div>

        <div class="brands-table">
            <div class="table-header">
                <h3>Lista de Marcas</h3>
                <div class="table-actions">
                    <a href="#" class="btn btn-primary">➕ Nueva Marca</a>
                    <a href="#" class="btn btn-secondary">📥 Exportar</a>
                </div>
            </div>

            @if($brands->count() > 0)
                <div class="stats-grid" style="padding: 1rem;">
                    <div class="stat-card">
                        <h4>{{ $brands->total() }}</h4>
                        <p>Total Marcas</p>
                    </div>
                    <div class="stat-card">
                        <h4>{{ $brands->where('is_eco_friendly', true)->count() }}</h4>
                        <p>Eco-friendly</p>
                    </div>
                    <div class="stat-card">
                        <h4>{{ $brands->where('is_active', true)->count() }}</h4>
                        <p>Activas</p>
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Marca</th>
                            <th>Descripción</th>
                            <th>País</th>
                            <th>Características</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td><input type="checkbox" class="brand-checkbox" value="{{ $brand->id }}"></td>
                                <td>
                                    <div class="brand-info">
                                        <div class="brand-icon">
                                            🏷️
                                        </div>
                                        <div class="brand-details">
                                            <h4>{{ $brand->name }}</h4>
                                            <p>ID: {{ $brand->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ Str::limit($brand->description ?? 'Sin descripción', 50) }}</td>
                                <td>{{ $brand->country ?? 'No especificado' }}</td>
                                <td>
                                    @if($brand->is_eco_friendly)
                                        <span class="badge eco">🌿 Eco-friendly</span>
                                    @endif
                                    @if($brand->is_premium)
                                        <span class="badge premium">⭐ Premium</span>
                                    @endif
                                    @if($brand->is_popular)
                                        <span class="badge popular">🔥 Popular</span>
                                    @endif
                                </td>
                                <td>
                                    @if($brand->is_active)
                                        <span class="badge eco">✅ Activa</span>
                                    @else
                                        <span class="badge">❌ Inactiva</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="#" class="btn btn-primary">✏️ Editar</a>
                                        <button class="btn btn-danger" onclick="deleteBrand({{ $brand->id }})">🗑️</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $brands->links() }}
                </div>
            @else
                <div class="no-brands">
                    <h3>No se encontraron marcas</h3>
                    <p>Intenta ajustar los filtros o crear nuevas marcas.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Select all checkbox functionality
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.brand-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Delete single brand
        function deleteBrand(brandId) {
            if (confirm('¿Estás seguro de que quieres eliminar esta marca?')) {
                // Here you would make an AJAX request to delete the brand
                console.log('Deleting brand:', brandId);
            }
        }

        // Bulk delete
        function bulkDelete() {
            const selected = document.querySelectorAll('.brand-checkbox:checked');
            if (selected.length === 0) {
                alert('Por favor selecciona al menos una marca para eliminar.');
                return;
            }

            if (confirm(`¿Estás seguro de que quieres eliminar ${selected.length} marcas?`)) {
                const ids = Array.from(selected).map(checkbox => checkbox.value);
                console.log('Bulk deleting brands:', ids);
                // Here you would make an AJAX request to delete multiple brands
            }
        }
    </script>
</body>
</html>