<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías - Clean Admin</title>
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
        
        .categories-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .categories-tree, .category-form {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
        
        .btn-success {
            background: #48bb78;
            color: white;
        }
        
        .btn-success:hover {
            background: #38a169;
        }
        
        .tree-container {
            padding: 1rem;
            max-height: 600px;
            overflow-y: auto;
        }
        
        .tree-item {
            margin: 0.5rem 0;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #fafafa;
            transition: all 0.2s;
        }
        
        .tree-item:hover {
            background: #f0f4f8;
            border-color: #cbd5e0;
        }
        
        .tree-item.level-1 {
            margin-left: 0;
            background: #f8fafc;
            border-left: 4px solid #667eea;
        }
        
        .tree-item.level-2 {
            margin-left: 2rem;
            background: #f0f4f8;
            border-left: 4px solid #4fd1c7;
        }
        
        .tree-item.level-3 {
            margin-left: 4rem;
            background: #f7fafc;
            border-left: 4px solid #9f7aea;
        }
        
        .category-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .category-details {
            flex: 1;
        }
        
        .category-name {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .category-meta {
            color: #718096;
            font-size: 0.9rem;
        }
        
        .category-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .category-icon {
            font-size: 1.2rem;
        }
        
        .form-container {
            padding: 1.5rem;
        }
        
        .form-group {
            margin-bottom: 1rem;
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
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            font-size: 0.9rem;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }
        
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }
        
        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }
        
        .badge.active {
            background: #f0fff4;
            color: #22543d;
        }
        
        .badge.inactive {
            background: #fed7d7;
            color: #742a2a;
        }
        
        .badge.has-children {
            background: #e6fffa;
            color: #234e52;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
            padding: 1rem;
            background: #f8fafc;
        }
        
        .stat-card {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
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
        
        .no-categories {
            text-align: center;
            padding: 3rem;
            color: #a0aec0;
        }
        
        .no-categories h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .expand-toggle {
            cursor: pointer;
            margin-right: 0.5rem;
            transition: transform 0.2s;
        }
        
        .expand-toggle.expanded {
            transform: rotate(90deg);
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
            <h1 class="page-title">📁 Gestión de Categorías</h1>
            <p>Organiza y administra las categorías de productos de limpieza</p>
        </div>

        <div class="categories-container">
            <!-- Árbol de Categorías -->
            <div class="categories-tree">
                <div class="section-header">
                    <h3>🌳 Árbol de Categorías</h3>
                    <button class="btn btn-secondary" onclick="expandAll()">📖 Expandir Todo</button>
                </div>

                @if($categories && count($categories) > 0)
                    <div class="stats-grid">
                        <div class="stat-card">
                            <h4>{{ collect($categories)->flatten()->count() }}</h4>
                            <p>Total</p>
                        </div>
                        <div class="stat-card">
                            <h4>{{ collect($categories)->where('is_active', true)->count() }}</h4>
                            <p>Activas</p>
                        </div>
                        <div class="stat-card">
                            <h4>{{ collect($categories)->where('parent_id', null)->count() }}</h4>
                            <p>Principales</p>
                        </div>
                    </div>

                    <div class="tree-container">
                        @foreach($categories as $category)
                            @include('clean-admin::categories.partials.category-tree-item', ['category' => $category, 'level' => 1])
                        @endforeach
                    </div>
                @else
                    <div class="no-categories">
                        <h3>No hay categorías creadas</h3>
                        <p>Comienza creando tu primera categoría usando el formulario.</p>
                    </div>
                @endif
            </div>

            <!-- Formulario de Categoría -->
            <div class="category-form">
                <div class="section-header">
                    <h3>📝 <span id="form-title">Nueva Categoría</span></h3>
                    <button class="btn btn-secondary" onclick="resetForm()">🔄 Limpiar</button>
                </div>

                <div class="form-container">
                    <form id="category-form" action="#" method="POST">
                        @csrf
                        <input type="hidden" id="category-id" name="id" value="">
                        
                        <div class="form-group">
                            <label for="name">Nombre *</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" name="slug" placeholder="Se genera automáticamente">
                        </div>

                        <div class="form-group">
                            <label for="parent_id">Categoría Padre</label>
                            <select id="parent_id" name="parent_id">
                                <option value="">-- Categoría Principal --</option>
                                @if($categories)
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea id="description" name="description" placeholder="Descripción de la categoría"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="sort_order">Orden</label>
                            <input type="number" id="sort_order" name="sort_order" value="0" min="0">
                        </div>

                        <div class="form-group">
                            <label for="is_active">Estado</label>
                            <select id="is_active" name="is_active">
                                <option value="1">Activa</option>
                                <option value="0">Inactiva</option>
                            </select>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">Cancelar</button>
                            <button type="submit" class="btn btn-success">💾 Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Generate slug from name
        document.getElementById('name').addEventListener('input', function() {
            const name = this.value;
            const slug = name.toLowerCase()
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            document.getElementById('slug').value = slug;
        });

        // Edit category
        function editCategory(id, name, slug, parentId, description, sortOrder, isActive) {
            document.getElementById('form-title').textContent = 'Editar Categoría';
            document.getElementById('category-id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('slug').value = slug;
            document.getElementById('parent_id').value = parentId || '';
            document.getElementById('description').value = description || '';
            document.getElementById('sort_order').value = sortOrder || 0;
            document.getElementById('is_active').value = isActive ? '1' : '0';
        }

        // Reset form
        function resetForm() {
            document.getElementById('form-title').textContent = 'Nueva Categoría';
            document.getElementById('category-form').reset();
            document.getElementById('category-id').value = '';
        }

        // Delete category
        function deleteCategory(id, name) {
            if (confirm(`¿Estás seguro de que quieres eliminar la categoría "${name}"?`)) {
                // Here you would make an AJAX request to delete the category
                console.log('Deleting category:', id);
            }
        }

        // Toggle category expansion
        function toggleCategory(element) {
            const toggle = element.querySelector('.expand-toggle');
            const children = element.parentElement.querySelector('.children');
            
            if (children) {
                if (children.style.display === 'none') {
                    children.style.display = 'block';
                    toggle.classList.add('expanded');
                } else {
                    children.style.display = 'none';
                    toggle.classList.remove('expanded');
                }
            }
        }

        // Expand all categories
        function expandAll() {
            const toggles = document.querySelectorAll('.expand-toggle');
            const children = document.querySelectorAll('.children');
            
            toggles.forEach(toggle => toggle.classList.add('expanded'));
            children.forEach(child => child.style.display = 'block');
        }

        // Form submission
        document.getElementById('category-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const isEditing = document.getElementById('category-id').value !== '';
            
            console.log('Form data:', Object.fromEntries(formData));
            
            // Here you would make an AJAX request to save the category
            alert(isEditing ? 'Categoría actualizada' : 'Categoría creada');
            
            if (!isEditing) {
                resetForm();
            }
        });
    </script>
</body>
</html>