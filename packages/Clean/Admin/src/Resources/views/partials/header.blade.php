<header>
    <div class="container">
        <div class="header-content">
            <div class="logo">🧽 Clean Admin</div>
            <nav class="nav-links">
                <a href="{{ route('admin.clean.dashboard') }}" class="{{ request()->routeIs('admin.clean.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.clean.products.index') }}" class="{{ request()->routeIs('admin.clean.products*') ? 'active' : '' }}">Productos</a>
                <a href="{{ route('admin.clean.brands.index') }}" class="{{ request()->routeIs('admin.clean.brands*') ? 'active' : '' }}">Marcas</a>
                <a href="{{ route('admin.clean.categories.index') }}" class="{{ request()->routeIs('admin.clean.categories*') ? 'active' : '' }}">Categorías</a>
                <a href="{{ route('admin.clean.ingredients.index') }}" class="{{ request()->routeIs('admin.clean.ingredients*') ? 'active' : '' }}">Ingredientes</a>
                <a href="{{ route('admin.clean.safety') }}" class="{{ request()->routeIs('admin.clean.safety*') ? 'active' : '' }}">Seguridad</a>
                <a href="{{ route('admin.clean.analytics') }}" class="{{ request()->routeIs('admin.clean.analytics*') ? 'active' : '' }}">Análisis</a>
                <a href="{{ route('admin.clean.settings') }}" class="{{ request()->routeIs('admin.clean.settings*') ? 'active' : '' }}">Configuración</a>
            </nav>
        </div>
    </div>
</header>