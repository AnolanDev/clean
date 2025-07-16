<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ingredientes - Clean Admin</title>
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
        
        .btn-warning {
            background: #ed8936;
            color: white;
        }
        
        .btn-warning:hover {
            background: #dd6b20;
        }
        
        .ingredients-table {
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
        
        .ingredient-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .ingredient-icon {
            font-size: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #e2e8f0;
        }
        
        .ingredient-icon.natural {
            background: linear-gradient(45deg, #c6f6d5, #9ae6b4);
        }
        
        .ingredient-icon.synthetic {
            background: linear-gradient(45deg, #fbb6ce, #f687b3);
        }
        
        .ingredient-icon.chemical {
            background: linear-gradient(45deg, #fed7d7, #feb2b2);
        }
        
        .ingredient-details h4 {
            margin-bottom: 0.25rem;
            color: #2d3748;
        }
        
        .ingredient-details p {
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
        
        .badge.safe {
            background: #f0fff4;
            color: #22543d;
        }
        
        .badge.warning {
            background: #fef5e7;
            color: #744210;
        }
        
        .badge.danger {
            background: #fed7d7;
            color: #742a2a;
        }
        
        .badge.natural {
            background: #e6fffa;
            color: #234e52;
        }
        
        .badge.synthetic {
            background: #faf5ff;
            color: #553c9a;
        }
        
        .badge.chemical {
            background: #fff5f5;
            color: #742a2a;
        }
        
        .actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .safety-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .safety-dots {
            display: flex;
            gap: 2px;
        }
        
        .safety-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #e2e8f0;
        }
        
        .safety-dot.active {
            background: #48bb78;
        }
        
        .safety-dot.warning {
            background: #ed8936;
        }
        
        .safety-dot.danger {
            background: #f56565;
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
        
        .no-ingredients {
            text-align: center;
            padding: 3rem;
            color: #a0aec0;
        }
        
        .no-ingredients h3 {
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
        
        .ingredient-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 2rem;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .close:hover {
            color: black;
        }
        
        .modal-header {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .modal-section {
            margin-bottom: 1.5rem;
        }
        
        .modal-section h4 {
            margin-bottom: 0.5rem;
            color: #4a5568;
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
            <h1 class="page-title">🧪 Gestión de Ingredientes</h1>
            <p>Administra los ingredientes y componentes químicos de productos de limpieza</p>
        </div>

        <div class="filters">
            <h3>🔍 Filtros</h3>
            <form method="GET" action="{{ route('admin.clean.ingredients') }}">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label>Tipo de Ingrediente</label>
                        <select name="type">
                            <option value="">Todos los tipos</option>
                            <option value="natural" {{ request('type') == 'natural' ? 'selected' : '' }}>Natural</option>
                            <option value="synthetic" {{ request('type') == 'synthetic' ? 'selected' : '' }}>Sintético</option>
                            <option value="chemical" {{ request('type') == 'chemical' ? 'selected' : '' }}>Químico</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label>Nivel de Seguridad</label>
                        <select name="safety_level">
                            <option value="">Todos los niveles</option>
                            <option value="safe" {{ request('safety_level') == 'safe' ? 'selected' : '' }}>Seguro</option>
                            <option value="mild" {{ request('safety_level') == 'mild' ? 'selected' : '' }}>Suave</option>
                            <option value="moderate" {{ request('safety_level') == 'moderate' ? 'selected' : '' }}>Moderado</option>
                            <option value="high" {{ request('safety_level') == 'high' ? 'selected' : '' }}>Alto riesgo</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label>Origen</label>
                        <select name="natural">
                            <option value="">Todos los orígenes</option>
                            <option value="1" {{ request('natural') == '1' ? 'selected' : '' }}>Natural</option>
                            <option value="0" {{ request('natural') == '0' ? 'selected' : '' }}>Sintético</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label>Búsqueda</label>
                        <input type="text" name="search" placeholder="Buscar ingredientes..." value="{{ request('search') }}">
                    </div>
                </div>
                
                <div style="margin-top: 1rem;">
                    <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                    <a href="{{ route('admin.clean.ingredients') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </form>
        </div>

        <div class="ingredients-table">
            <div class="table-header">
                <h3>Lista de Ingredientes</h3>
                <div class="table-actions">
                    <a href="#" class="btn btn-primary">➕ Nuevo Ingrediente</a>
                    <a href="#" class="btn btn-secondary">📥 Exportar</a>
                    <a href="#" class="btn btn-warning">⚠️ Reporte de Seguridad</a>
                </div>
            </div>

            @if($ingredients->count() > 0)
                <div class="stats-grid" style="padding: 1rem;">
                    <div class="stat-card">
                        <h4>{{ $ingredients->total() }}</h4>
                        <p>Total Ingredientes</p>
                    </div>
                    <div class="stat-card">
                        <h4>{{ $ingredients->where('is_natural', true)->count() }}</h4>
                        <p>Naturales</p>
                    </div>
                    <div class="stat-card">
                        <h4>{{ $ingredients->where('safety_level', 'safe')->count() }}</h4>
                        <p>Seguros</p>
                    </div>
                    <div class="stat-card">
                        <h4>{{ $ingredients->where('safety_level', 'high')->count() }}</h4>
                        <p>Alto Riesgo</p>
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Ingrediente</th>
                            <th>Tipo</th>
                            <th>Función</th>
                            <th>Seguridad</th>
                            <th>Origen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ingredients as $ingredient)
                            <tr>
                                <td><input type="checkbox" class="ingredient-checkbox" value="{{ $ingredient->id }}"></td>
                                <td>
                                    <div class="ingredient-info">
                                        <div class="ingredient-icon {{ $ingredient->type ?? 'natural' }}">
                                            @switch($ingredient->type ?? 'natural')
                                                @case('natural') 🌿 @break
                                                @case('synthetic') ⚗️ @break
                                                @case('chemical') 🧪 @break
                                                @default 🌿
                                            @endswitch
                                        </div>
                                        <div class="ingredient-details">
                                            <h4>{{ $ingredient->name }}</h4>
                                            <p>{{ $ingredient->chemical_formula ?? 'No especificado' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $ingredient->type ?? 'natural' }}">
                                        {{ ucfirst($ingredient->type ?? 'Natural') }}
                                    </span>
                                </td>
                                <td>{{ $ingredient->function ?? 'No especificado' }}</td>
                                <td>
                                    <div class="safety-indicator">
                                        @switch($ingredient->safety_level ?? 'safe')
                                            @case('safe')
                                                <span class="badge safe">✅ Seguro</span>
                                                @break
                                            @case('mild')
                                                <span class="badge warning">⚠️ Suave</span>
                                                @break
                                            @case('moderate')
                                                <span class="badge warning">⚠️ Moderado</span>
                                                @break
                                            @case('high')
                                                <span class="badge danger">☠️ Alto riesgo</span>
                                                @break
                                            @default
                                                <span class="badge safe">✅ Seguro</span>
                                        @endswitch
                                    </div>
                                </td>
                                <td>
                                    @if($ingredient->is_natural)
                                        <span class="badge natural">🌿 Natural</span>
                                    @else
                                        <span class="badge synthetic">⚗️ Sintético</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions">
                                        <button class="btn btn-primary" onclick="showIngredientDetails({{ $ingredient->id }})">👁️</button>
                                        <a href="#" class="btn btn-primary">✏️</a>
                                        <button class="btn btn-danger" onclick="deleteIngredient({{ $ingredient->id }})">🗑️</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $ingredients->links() }}
                </div>
            @else
                <div class="no-ingredients">
                    <h3>No se encontraron ingredientes</h3>
                    <p>Intenta ajustar los filtros o crear nuevos ingredientes.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal para detalles del ingrediente -->
    <div id="ingredient-modal" class="ingredient-modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <h2 id="modal-title">Detalles del Ingrediente</h2>
            </div>
            <div id="modal-body">
                <!-- Contenido dinámico -->
            </div>
        </div>
    </div>

    <script>
        // Select all checkbox functionality
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.ingredient-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Show ingredient details modal
        function showIngredientDetails(ingredientId) {
            // Aquí harías una petición AJAX para obtener los detalles
            const modal = document.getElementById('ingredient-modal');
            const modalTitle = document.getElementById('modal-title');
            const modalBody = document.getElementById('modal-body');
            
            modalTitle.textContent = `Ingrediente ID: ${ingredientId}`;
            modalBody.innerHTML = `
                <div class="modal-section">
                    <h4>🧪 Información Química</h4>
                    <p><strong>Fórmula:</strong> C₈H₁₈O₂</p>
                    <p><strong>Peso Molecular:</strong> 146.23 g/mol</p>
                    <p><strong>CAS:</strong> 123-45-6</p>
                </div>
                <div class="modal-section">
                    <h4>⚠️ Información de Seguridad</h4>
                    <p><strong>Nivel de Peligro:</strong> <span class="badge safe">✅ Seguro</span></p>
                    <p><strong>Precauciones:</strong> Evitar contacto con los ojos</p>
                    <p><strong>Efectos secundarios:</strong> Posible irritación en piel sensible</p>
                </div>
                <div class="modal-section">
                    <h4>🌿 Información Ambiental</h4>
                    <p><strong>Biodegradable:</strong> Sí</p>
                    <p><strong>Origen:</strong> Natural</p>
                    <p><strong>Impacto ambiental:</strong> Bajo</p>
                </div>
                <div class="modal-section">
                    <h4>📋 Regulaciones</h4>
                    <p><strong>Aprobado por:</strong> EPA, FDA</p>
                    <p><strong>Restricciones:</strong> Ninguna</p>
                </div>
            `;
            
            modal.style.display = 'block';
        }

        // Close modal
        function closeModal() {
            document.getElementById('ingredient-modal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('ingredient-modal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }

        // Delete ingredient
        function deleteIngredient(ingredientId) {
            if (confirm('¿Estás seguro de que quieres eliminar este ingrediente?')) {
                console.log('Deleting ingredient:', ingredientId);
                // Aquí harías una petición AJAX para eliminar
            }
        }

        // Bulk operations
        function bulkOperation(operation) {
            const selected = document.querySelectorAll('.ingredient-checkbox:checked');
            if (selected.length === 0) {
                alert('Por favor selecciona al menos un ingrediente.');
                return;
            }

            const ids = Array.from(selected).map(checkbox => checkbox.value);
            console.log(`Bulk ${operation} ingredients:`, ids);
        }
    </script>
</body>
</html>