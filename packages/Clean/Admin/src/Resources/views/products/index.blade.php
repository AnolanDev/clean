<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - Clean Admin</title>
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
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
        
        .products-table {
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
        
        .product-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .product-icon {
            font-size: 2rem;
            width: 50px;
            height: 50px;
            background: linear-gradient(45deg, #f7fafc, #edf2f7);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .product-details h4 {
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
        
        .no-products {
            text-align: center;
            padding: 3rem;
            color: #a0aec0;
        }
        
        .no-products h3 {
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
            <h1 class="page-title">📦 Gestión de Productos</h1>
            <p>Administra el catálogo completo de productos de limpieza</p>
        </div>

        <div class="filters">
            <h3>🔍 Filtros</h3>
            <form method="GET" action="{{ route('admin.clean.products') }}">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label>Marca</label>
                        <select name="brand_id">
                            <option value="">Todas las marcas</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label>Categoría</label>
                        <select name="category_id">
                            <option value="">Todas las categorías</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label>Nivel de Seguridad</label>
                        <select name="safety_level">
                            <option value="">Todos los niveles</option>
                            <option value="non_hazardous" {{ request('safety_level') == 'non_hazardous' ? 'selected' : '' }}>No peligroso</option>
                            <option value="irritant" {{ request('safety_level') == 'irritant' ? 'selected' : '' }}>Irritante</option>
                            <option value="corrosive" {{ request('safety_level') == 'corrosive' ? 'selected' : '' }}>Corrosivo</option>
                            <option value="toxic" {{ request('safety_level') == 'toxic' ? 'selected' : '' }}>Tóxico</option>
                            <option value="flammable" {{ request('safety_level') == 'flammable' ? 'selected' : '' }}>Inflamable</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label>Búsqueda</label>
                        <input type="text" name="search" placeholder="Buscar productos..." value="{{ request('search') }}">
                    </div>
                </div>
                
                <div style="margin-top: 1rem;">
                    <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                    <a href="{{ route('admin.clean.products') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </form>
        </div>

        <div class="products-table">
            <div class="table-header">
                <h3>Lista de Productos</h3>
                <div class="table-actions">
                    <a href="{{ route('admin.clean.products.export') }}" class="btn btn-secondary">📥 Exportar</a>
                    <button class="btn btn-danger" onclick="bulkDelete()">🗑️ Eliminar Seleccionados</button>
                </div>
            </div>

            @if($products->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Producto</th>
                            <th>Marca</th>
                            <th>Categoría</th>
                            <th>Tipo</th>
                            <th>Seguridad</th>
                            <th>Características</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><input type="checkbox" class="product-checkbox" value="{{ $product->id }}"></td>
                                <td>
                                    <div class="product-info">
                                        <div class="product-icon">
                                            @switch($product->product_type)
                                                @case('liquid') 🧴 @break
                                                @case('powder') 📦 @break
                                                @case('gel') 🫧 @break
                                                @case('spray') 🏷️ @break
                                                @default 🧼
                                            @endswitch
                                        </div>
                                        <div class="product-details">
                                            <h4>{{ $product->product->name ?? 'Producto #' . $product->id }}</h4>
                                            <p>ID: {{ $product->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->brand->name ?? 'Sin marca' }}</td>
                                <td>{{ $product->category->name ?? 'Sin categoría' }}</td>
                                <td>{{ ucfirst($product->product_type) }}</td>
                                <td>
                                    @switch($product->safety_classification)
                                        @case('non_hazardous')
                                            <span class="badge safe">✅ Seguro</span>
                                            @break
                                        @case('irritant')
                                            <span class="badge warning">⚠️ Irritante</span>
                                            @break
                                        @case('corrosive')
                                            <span class="badge danger">🔥 Corrosivo</span>
                                            @break
                                        @case('toxic')
                                            <span class="badge danger">☠️ Tóxico</span>
                                            @break
                                        @case('flammable')
                                            <span class="badge warning">🔥 Inflamable</span>
                                            @break
                                        @default
                                            <span class="badge">{{ ucfirst($product->safety_classification) }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if($product->is_eco_friendly)
                                        <span class="badge eco">🌿 Eco</span>
                                    @endif
                                    @if($product->is_antibacterial)
                                        <span class="badge">🦠 Antibacterial</span>
                                    @endif
                                    @if($product->is_biodegradable)
                                        <span class="badge eco">♻️ Biodegradable</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="#" class="btn btn-primary">✏️ Editar</a>
                                        <button class="btn btn-danger" onclick="deleteProduct({{ $product->id }})">🗑️</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $products->links() }}
                </div>
            @else
                <div class="no-products">
                    <h3>No se encontraron productos</h3>
                    <p>Intenta ajustar los filtros o crear nuevos productos.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Select all checkbox functionality
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.product-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Delete single product
        function deleteProduct(productId) {
            if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
                // Here you would make an AJAX request to delete the product
                console.log('Deleting product:', productId);
            }
        }

        // Bulk delete
        function bulkDelete() {
            const selected = document.querySelectorAll('.product-checkbox:checked');
            if (selected.length === 0) {
                alert('Por favor selecciona al menos un producto para eliminar.');
                return;
            }

            if (confirm(`¿Estás seguro de que quieres eliminar ${selected.length} productos?`)) {
                const ids = Array.from(selected).map(checkbox => checkbox.value);
                console.log('Bulk deleting products:', ids);
                // Here you would make an AJAX request to delete multiple products
            }
        }
    </script>
</body>
</html>