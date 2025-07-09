<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos de Limpieza - Clean</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 2rem;
            font-weight: bold;
        }
        
        .search-bar {
            flex: 1;
            max-width: 400px;
            margin: 0 2rem;
        }
        
        .search-bar input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            outline: none;
        }
        
        .stats {
            display: flex;
            gap: 1rem;
            font-size: 0.9rem;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: bold;
            display: block;
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
        
        .filter-group select {
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            font-size: 0.9rem;
        }
        
        .checkbox-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
        
        .product-image {
            height: 200px;
            background: linear-gradient(45deg, #f7fafc, #edf2f7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #a0aec0;
        }
        
        .product-info {
            padding: 1.5rem;
        }
        
        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #2d3748;
        }
        
        .product-brand {
            color: #667eea;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .product-features {
            display: flex;
            gap: 0.5rem;
            margin: 1rem 0;
            flex-wrap: wrap;
        }
        
        .feature-badge {
            background: #e6fffa;
            color: #234e52;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .feature-badge.eco {
            background: #f0fff4;
            color: #22543d;
        }
        
        .feature-badge.antibacterial {
            background: #fef5e7;
            color: #744210;
        }
        
        .safety-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0.5rem 0;
        }
        
        .stars {
            color: #f6ad55;
        }
        
        .product-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
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
        
        .no-products {
            text-align: center;
            padding: 3rem;
            color: #a0aec0;
        }
        
        .no-products h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .categories-section {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            margin: 2rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .category-card {
            background: #f7fafc;
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
            color: #4a5568;
            transition: all 0.2s;
            border: 1px solid #e2e8f0;
        }
        
        .category-card:hover {
            background: #edf2f7;
            transform: translateY(-2px);
        }
        
        .category-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .category-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        footer {
            background: #2d3748;
            color: white;
            padding: 2rem 0;
            text-align: center;
            margin-top: 3rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">🧽 Clean Catalog</div>
                <div class="search-bar">
                    <form action="{{ route('catalog.search') }}" method="GET">
                        <input type="text" name="q" placeholder="Buscar productos de limpieza..." value="{{ request('q') }}">
                    </form>
                </div>
                <div class="stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ $statistics['total_products'] }}</span>
                        <span>Productos</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $statistics['eco_friendly'] }}</span>
                        <span>Ecológicos</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $statistics['brands'] }}</span>
                        <span>Marcas</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="filters">
            <h3>🔍 Filtros</h3>
            <form method="GET" action="{{ route('catalog.index') }}">
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
                        <label>Tipo de producto</label>
                        <select name="product_type">
                            <option value="">Todos los tipos</option>
                            <option value="liquid" {{ request('product_type') == 'liquid' ? 'selected' : '' }}>Líquido</option>
                            <option value="powder" {{ request('product_type') == 'powder' ? 'selected' : '' }}>Polvo</option>
                            <option value="gel" {{ request('product_type') == 'gel' ? 'selected' : '' }}>Gel</option>
                            <option value="spray" {{ request('product_type') == 'spray' ? 'selected' : '' }}>Spray</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label>Nivel de pH</label>
                        <select name="ph_level">
                            <option value="">Todos los niveles</option>
                            <option value="acidic" {{ request('ph_level') == 'acidic' ? 'selected' : '' }}>Ácido</option>
                            <option value="neutral" {{ request('ph_level') == 'neutral' ? 'selected' : '' }}>Neutro</option>
                            <option value="alkaline" {{ request('ph_level') == 'alkaline' ? 'selected' : '' }}>Alcalino</option>
                        </select>
                    </div>
                </div>
                
                <div class="checkbox-group" style="margin-top: 1rem;">
                    <div class="checkbox-item">
                        <input type="checkbox" name="eco_friendly" value="1" {{ request('eco_friendly') ? 'checked' : '' }}>
                        <label>Ecológico</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" name="biodegradable" value="1" {{ request('biodegradable') ? 'checked' : '' }}>
                        <label>Biodegradable</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" name="antibacterial" value="1" {{ request('antibacterial') ? 'checked' : '' }}>
                        <label>Antibacterial</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" name="antiviral" value="1" {{ request('antiviral') ? 'checked' : '' }}>
                        <label>Antiviral</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" name="concentrated" value="1" {{ request('concentrated') ? 'checked' : '' }}>
                        <label>Concentrado</label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">Aplicar Filtros</button>
            </form>
        </div>

        <div class="categories-section">
            <h3>📂 Categorías</h3>
            <div class="categories-grid">
                @foreach($categories as $category)
                    <a href="{{ route('catalog.category', $category->slug) }}" class="category-card">
                        <div class="category-icon">
                            @switch($category->usage_area)
                                @case('kitchen') 🍳 @break
                                @case('bathroom') 🚿 @break
                                @case('floor') 🧽 @break
                                @case('glass') 🪟 @break
                                @case('multi_purpose') 🧹 @break
                                @default 🧼
                            @endswitch
                        </div>
                        <div class="category-name">{{ $category->name }}</div>
                        <div>{{ $category->products->count() }} productos</div>
                    </a>
                @endforeach
            </div>
        </div>

        @if($products->count() > 0)
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-image">
                            @switch($product->product_type)
                                @case('liquid') 🧴 @break
                                @case('powder') 📦 @break
                                @case('gel') 🫧 @break
                                @case('spray') 🏷️ @break
                                @default 🧼
                            @endswitch
                        </div>
                        <div class="product-info">
                            <div class="product-title">{{ $product->product->name ?? 'Producto #' . $product->id }}</div>
                            <div class="product-brand">{{ $product->brand->name ?? 'Sin marca' }}</div>
                            
                            <div class="product-features">
                                @if($product->is_eco_friendly)
                                    <span class="feature-badge eco">🌿 Ecológico</span>
                                @endif
                                @if($product->is_antibacterial)
                                    <span class="feature-badge antibacterial">🦠 Antibacterial</span>
                                @endif
                                @if($product->is_biodegradable)
                                    <span class="feature-badge">♻️ Biodegradable</span>
                                @endif
                                @if($product->is_concentrated)
                                    <span class="feature-badge">💧 Concentrado</span>
                                @endif
                            </div>
                            
                            <div class="safety-rating">
                                <span>Seguridad:</span>
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= \Clean\Core\Helpers\CleanProductHelper::getSafetyRating($product))
                                            ⭐
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            
                            <div class="product-actions">
                                <a href="{{ route('catalog.product.show', $product->id) }}" class="btn btn-primary">Ver detalles</a>
                                <button class="btn btn-secondary" onclick="addToCompare({{ $product->id }})">Comparar</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-products">
                <h3>No se encontraron productos</h3>
                <p>Intenta ajustar los filtros o realizar una búsqueda diferente.</p>
            </div>
        @endif
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 Clean Catalog. Catálogo de productos de limpieza profesional.</p>
        </div>
    </footer>

    <script>
        function addToCompare(productId) {
            let compareList = JSON.parse(localStorage.getItem('compareList') || '[]');
            
            if (compareList.includes(productId)) {
                alert('Este producto ya está en la lista de comparación');
                return;
            }
            
            if (compareList.length >= 4) {
                alert('Solo puedes comparar hasta 4 productos');
                return;
            }
            
            compareList.push(productId);
            localStorage.setItem('compareList', JSON.stringify(compareList));
            
            alert('Producto agregado a la comparación (' + compareList.length + '/4)');
        }
    </script>
</body>
</html>