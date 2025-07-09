{{-- Elemento del árbol de categorías --}}
<div class="tree-item level-{{ $level }}">
    <div class="category-info">
        <div class="category-details">
            <div class="category-name">
                @if(isset($category->children) && $category->children->count() > 0)
                    <span class="expand-toggle" onclick="toggleCategory(this.parentElement.parentElement.parentElement)">▶</span>
                @else
                    <span style="width: 1rem; display: inline-block;"></span>
                @endif
                
                <span class="category-icon">
                    @switch($level)
                        @case(1) 📁 @break
                        @case(2) 📂 @break
                        @default 📄
                    @endswitch
                </span>
                
                {{ $category->name }}
                
                @if($category->is_active)
                    <span class="badge active">✅ Activa</span>
                @else
                    <span class="badge inactive">❌ Inactiva</span>
                @endif
                
                @if(isset($category->children) && $category->children->count() > 0)
                    <span class="badge has-children">{{ $category->children->count() }} hijos</span>
                @endif
            </div>
            
            <div class="category-meta">
                ID: {{ $category->id }} | 
                Slug: {{ $category->slug ?? 'Sin slug' }} | 
                Orden: {{ $category->sort_order ?? 0 }}
                @if($category->description)
                    | {{ Str::limit($category->description, 50) }}
                @endif
            </div>
        </div>
        
        <div class="category-actions">
            <button class="btn btn-primary" onclick="editCategory(
                {{ $category->id }}, 
                '{{ addslashes($category->name) }}', 
                '{{ addslashes($category->slug ?? '') }}', 
                {{ $category->parent_id ?? 'null' }}, 
                '{{ addslashes($category->description ?? '') }}', 
                {{ $category->sort_order ?? 0 }}, 
                {{ $category->is_active ? 'true' : 'false' }}
            )">✏️</button>
            
            <button class="btn btn-danger" onclick="deleteCategory({{ $category->id }}, '{{ addslashes($category->name) }}')">🗑️</button>
        </div>
    </div>
</div>

{{-- Categorías hijas --}}
@if(isset($category->children) && $category->children->count() > 0)
    <div class="children" style="display: none;">
        @foreach($category->children as $child)
            @include('clean-admin::categories.partials.category-tree-item', ['category' => $child, 'level' => $level + 1])
        @endforeach
    </div>
@endif