# Estándares de Diseño Clean Admin

## 🎨 Paleta de Colores para Botones

### Botones Principales
- **Acción primaria**: `bg-emerald-500 hover:bg-emerald-600` (Verde Clean)
- **Buscar/Filtrar**: `bg-blue-500 hover:bg-blue-600` (Azul)

### Botones Secundarios por Función
- **Exportar**: `bg-purple-500 hover:bg-purple-600` (Morado)
- **Importar/Subir**: `bg-blue-500 hover:bg-blue-600` (Azul)
- **Carga Masiva**: `bg-orange-500 hover:bg-orange-600` (Naranja)
- **Continuar/Guardar secundario**: `bg-gray-500 hover:bg-gray-600` (Gris)
- **Cancelar**: `border border-gray-300 text-gray-700 hover:bg-gray-50` (Gris claro)

### Botones de Acción (Ver/Editar/Eliminar)
- **Ver**: `bg-blue-500 hover:bg-blue-600 text-white` (Azul sólido)
- **Editar**: `bg-yellow-500 hover:bg-yellow-600 text-white` (Amarillo sólido)
- **Eliminar**: `bg-red-500 hover:bg-red-600 text-white` (Rojo sólido)

## 📏 Tamaños Estándar

### Botones Principales
```css
px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200
```

### Botones Secundarios
```css
px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200
```

### Botones de Acción (Tabla)
```css
w-8 h-8 rounded-lg transition-colors duration-200
```

### Botones de Formulario
```css
px-6 py-2 rounded-lg text-sm font-medium transition-colors duration-200
```

## 🎯 Consistencia por Módulo

### Estructura de Botones Principales
1. **Crear/Nuevo**: Verde emerald (bg-emerald-500)
2. **Exportar**: Morado (bg-purple-500)
3. **Importar**: Azul (bg-blue-500)
4. **Carga Masiva**: Naranja (bg-orange-500)

### Responsive Text
- Desktop: Texto completo ("Nueva Marca", "Exportar", etc.)
- Mobile: Texto corto ("Nueva", "Export", etc.)
```html
<span class="hidden sm:inline">Texto Completo</span>
<span class="sm:hidden">Corto</span>
```

### Iconos
- Tamaño estándar: `w-4 h-4`
- Margen derecho: `mr-2` para principales, `mr-1` para secundarios
- SVG Heroicons para consistencia

## 🔄 Estados y Transiciones

### Efectos Hover
- Transición: `transition-colors duration-200`
- Colores hover: Mismo color base pero más oscuro (600 instead of 500)

### Estados de Focus
- Para accesibilidad: `focus:outline-none focus:ring-2 focus:ring-offset-2`
- Color del ring: Mismo que el color del botón

## 📱 Responsive Design

### Breakpoints
- `sm:` 640px y superior
- `md:` 768px y superior  
- `lg:` 1024px y superior

### Orden de Prioridad (Mobile First)
1. Botón principal (Crear)
2. Buscar
3. Acciones secundarias (solo iconos en móvil)

## 🛠️ Implementación

### HTML Base para Botón Principal
```html
<a href="#" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <!-- Icono SVG -->
    </svg>
    <span class="hidden sm:inline">Texto Completo</span>
    <span class="sm:hidden">Corto</span>
</a>
```

### HTML Base para Botón de Acción
```html
<a href="#" class="inline-flex items-center justify-center w-8 h-8 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors duration-200" title="Descripción">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <!-- Icono SVG -->
    </svg>
</a>
```

## ✅ Checklist de Consistencia

- [ ] Botón principal usa bg-emerald-500
- [ ] Botones de acción usan backgrounds sólidos
- [ ] Tamaños consistentes (px-4 py-2 para principales)
- [ ] Transiciones uniformes (duration-200)
- [ ] Texto responsive implementado
- [ ] Iconos de tamaño estándar (w-4 h-4)
- [ ] Estados hover definidos
- [ ] Rounded corners consistentes (rounded-lg)