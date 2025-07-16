<?php

namespace Clean\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Clean\Core\Models\CleanIngredient;

class IngredientController extends Controller
{
    /**
     * Display a listing of ingredients.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'search', 'type', 'safety_level', 'is_natural', 'is_biodegradable', 'sort_by', 'sort_order'
        ]);

        // Construir query con filtros
        $query = CleanIngredient::withCount('products')
            ->when($filters['search'] ?? null, fn($q, $search) => 
                $q->where(function($subQ) use ($search) {
                    $subQ->where('name', 'like', "%{$search}%")
                         ->orWhere('chemical_name', 'like', "%{$search}%")
                         ->orWhere('cas_number', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%");
                }))
            ->when($filters['type'] ?? null, fn($q, $type) => 
                $q->where('type', $type))
            ->when($filters['safety_level'] ?? null, fn($q, $level) => 
                $q->where('safety_level', $level))
            ->when(isset($filters['is_natural']), fn($q) => 
                $q->where('is_natural', true))
            ->when(isset($filters['is_biodegradable']), fn($q) => 
                $q->where('is_biodegradable', true));

        // Ordenamiento
        $sortBy = $filters['sort_by'] ?? 'name';
        $sortOrder = $filters['sort_order'] ?? 'asc';
        $query->orderBy($sortBy, $sortOrder);

        $ingredients = $query->paginate(20)->withQueryString();

        // Estadísticas
        $totalIngredients = CleanIngredient::count();
        $naturalIngredients = CleanIngredient::where('is_natural', true)->count();
        $biodegradableIngredients = CleanIngredient::where('is_biodegradable', true)->count();
        $hazardousIngredients = CleanIngredient::where('safety_level', 'hazardous')->count();

        // Listas para filtros
        $ingredientTypes = CleanIngredient::select('type')
            ->whereNotNull('type')
            ->distinct()
            ->orderBy('type')
            ->pluck('type');

        $safetyLevels = ['low', 'medium', 'high', 'hazardous'];

        return view('clean-admin::ingredients.index', compact(
            'ingredients', 'ingredientTypes', 'safetyLevels', 'filters',
            'totalIngredients', 'naturalIngredients', 'biodegradableIngredients', 'hazardousIngredients'
        ));
    }

    /**
     * Show the form for creating a new ingredient.
     */
    public function create()
    {
        $ingredientTypes = ['surfactant', 'solvent', 'preservative', 'fragrance', 'colorant', 'buffer', 'thickener', 'active', 'other'];
        $safetyLevels = ['low', 'medium', 'high', 'hazardous'];
        $hazardSymbols = ['irritant', 'corrosive', 'toxic', 'harmful', 'flammable', 'explosive', 'oxidizing', 'environmental'];

        return view('clean-admin::ingredients.create', compact(
            'ingredientTypes', 'safetyLevels', 'hazardSymbols'
        ));
    }

    /**
     * Store a newly created ingredient in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateIngredient($request);

        try {
            DB::beginTransaction();

            // Procesar símbolos de peligro
            $validated['hazard_symbols'] = $this->processHazardSymbols($request->input('hazard_symbols'));

            // Crear ingrediente
            $ingredient = CleanIngredient::create($validated);

            DB::commit();

            return redirect()
                ->route('admin.clean.ingredients.show', $ingredient)
                ->with('success', 'Ingrediente creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error al crear ingrediente: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear el ingrediente: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified ingredient.
     */
    public function show(CleanIngredient $cleanIngredient)
    {
        $cleanIngredient->loadCount('products');
        
        // Obtener productos que usan este ingrediente
        $recentProducts = $cleanIngredient->products()
            ->with('brand')
            ->latest()
            ->limit(10)
            ->get();

        // Obtener ingredientes similares (mismo tipo)
        $similarIngredients = CleanIngredient::where('type', $cleanIngredient->type)
            ->where('id', '!=', $cleanIngredient->id)
            ->limit(5)
            ->get();

        return view('clean-admin::ingredients.show', [
            'ingredient' => $cleanIngredient,
            'recentProducts' => $recentProducts,
            'similarIngredients' => $similarIngredients
        ]);
    }

    /**
     * Show the form for editing the specified ingredient.
     */
    public function edit(CleanIngredient $cleanIngredient)
    {
        $ingredientTypes = ['surfactant', 'solvent', 'preservative', 'fragrance', 'colorant', 'buffer', 'thickener', 'active', 'other'];
        $safetyLevels = ['low', 'medium', 'high', 'hazardous'];
        $hazardSymbols = ['irritant', 'corrosive', 'toxic', 'harmful', 'flammable', 'explosive', 'oxidizing', 'environmental'];

        return view('clean-admin::ingredients.edit', [
            'ingredient' => $cleanIngredient,
            'ingredientTypes' => $ingredientTypes,
            'safetyLevels' => $safetyLevels,
            'hazardSymbols' => $hazardSymbols
        ]);
    }

    /**
     * Update the specified ingredient in storage.
     */
    public function update(Request $request, CleanIngredient $cleanIngredient)
    {
        $validated = $this->validateIngredient($request, $cleanIngredient);

        try {
            DB::beginTransaction();

            // Procesar símbolos de peligro
            $validated['hazard_symbols'] = $this->processHazardSymbols($request->input('hazard_symbols'));

            // Actualizar ingrediente
            $cleanIngredient->update($validated);

            DB::commit();

            return redirect()
                ->route('admin.clean.ingredients.show', $cleanIngredient)
                ->with('success', 'Ingrediente actualizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error al actualizar ingrediente: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar el ingrediente: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified ingredient from storage.
     */
    public function destroy(CleanIngredient $cleanIngredient)
    {
        try {
            DB::beginTransaction();

            // Verificar si tiene productos asociados
            if ($cleanIngredient->products()->count() > 0) {
                return back()->withErrors([
                    'error' => 'No se puede eliminar el ingrediente porque está siendo usado en productos.'
                ]);
            }

            // Eliminar ingrediente
            $cleanIngredient->delete();

            DB::commit();

            return redirect()
                ->route('admin.clean.ingredients.index')
                ->with('success', 'Ingrediente eliminado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error al eliminar ingrediente: ' . $e->getMessage());
            
            return back()
                ->withErrors(['error' => 'Error al eliminar el ingrediente: ' . $e->getMessage()]);
        }
    }

    /**
     * Bulk operations on ingredients.
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:delete,mark_natural,mark_synthetic,mark_biodegradable,mark_non_biodegradable,export',
            'ingredient_ids' => 'required|array|min:1',
            'ingredient_ids.*' => 'exists:clean_ingredients,id'
        ]);

        try {
            $count = 0;
            $ingredientIds = $validated['ingredient_ids'];

            switch ($validated['action']) {
                case 'delete':
                    $count = $this->bulkDelete($ingredientIds);
                    break;
                    
                case 'mark_natural':
                    $count = $this->bulkUpdateNatural($ingredientIds, true);
                    break;
                    
                case 'mark_synthetic':
                    $count = $this->bulkUpdateNatural($ingredientIds, false);
                    break;
                    
                case 'mark_biodegradable':
                    $count = $this->bulkUpdateBiodegradable($ingredientIds, true);
                    break;
                    
                case 'mark_non_biodegradable':
                    $count = $this->bulkUpdateBiodegradable($ingredientIds, false);
                    break;
                    
                case 'export':
                    return $this->bulkExport($ingredientIds);
            }

            return response()->json([
                'success' => true,
                'message' => "Operación completada en {$count} ingredientes.",
                'count' => $count
            ]);

        } catch (\Exception $e) {
            logger()->error('Error en operación masiva de ingredientes: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error en la operación: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export ingredients to CSV/Excel.
     */
    public function export(Request $request)
    {
        $format = $request->input('format', 'csv');
        $filters = $request->only(['search', 'type', 'safety_level', 'is_natural', 'is_biodegradable']);

        $ingredients = CleanIngredient::withCount('products')
            ->when($filters['search'] ?? null, fn($q, $search) => 
                $q->where('name', 'like', "%{$search}%"))
            ->when($filters['type'] ?? null, fn($q, $type) => 
                $q->where('type', $type))
            ->when($filters['safety_level'] ?? null, fn($q, $level) => 
                $q->where('safety_level', $level))
            ->when(isset($filters['is_natural']), fn($q) => 
                $q->where('is_natural', true))
            ->when(isset($filters['is_biodegradable']), fn($q) => 
                $q->where('is_biodegradable', true))
            ->orderBy('name')
            ->get();

        return $this->generateExport($ingredients, $format);
    }

    /**
     * Get safety information for an ingredient.
     */
    public function safetyInfo(CleanIngredient $cleanIngredient)
    {
        return response()->json([
            'safety_level' => $cleanIngredient->safety_level,
            'hazard_symbols' => $cleanIngredient->hazard_symbols,
            'safety_instructions' => $cleanIngredient->safety_instructions,
            'is_natural' => $cleanIngredient->is_natural,
            'is_biodegradable' => $cleanIngredient->is_biodegradable,
            'concentration_range' => $cleanIngredient->getConcentrationRange()
        ]);
    }

    /**
     * Validate ingredient data.
     */
    private function validateIngredient(Request $request, ?CleanIngredient $ingredient = null): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'chemical_name' => 'nullable|string|max:255',
            'cas_number' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'type' => 'required|in:surfactant,solvent,preservative,fragrance,colorant,buffer,thickener,active,other',
            'safety_level' => 'required|in:low,medium,high,hazardous',
            'is_natural' => 'boolean',
            'is_biodegradable' => 'boolean',
            'safety_instructions' => 'nullable|string',
            'concentration_min' => 'nullable|numeric|min:0|max:100',
            'concentration_max' => 'nullable|numeric|min:0|max:100|gte:concentration_min',
            'hazard_symbols' => 'nullable|array',
            'hazard_symbols.*' => 'in:irritant,corrosive,toxic,harmful,flammable,explosive,oxidizing,environmental'
        ];

        // Validar unicidad del nombre
        if ($ingredient) {
            $rules['name'] .= '|unique:clean_ingredients,name,' . $ingredient->id;
            if ($request->input('cas_number')) {
                $rules['cas_number'] .= '|unique:clean_ingredients,cas_number,' . $ingredient->id;
            }
        } else {
            $rules['name'] .= '|unique:clean_ingredients,name';
            if ($request->input('cas_number')) {
                $rules['cas_number'] .= '|unique:clean_ingredients,cas_number';
            }
        }

        return $request->validate($rules);
    }

    /**
     * Process hazard symbols from array.
     */
    private function processHazardSymbols(?array $hazardSymbols): array
    {
        if (empty($hazardSymbols)) {
            return [];
        }

        return array_filter($hazardSymbols, fn($symbol) => !empty($symbol));
    }

    /**
     * Bulk delete ingredients.
     */
    private function bulkDelete(array $ingredientIds): int
    {
        return DB::transaction(function () use ($ingredientIds) {
            $ingredients = CleanIngredient::whereIn('id', $ingredientIds)
                ->whereDoesntHave('products')
                ->get();

            return CleanIngredient::whereIn('id', $ingredients->pluck('id'))->delete();
        });
    }

    /**
     * Bulk update natural status.
     */
    private function bulkUpdateNatural(array $ingredientIds, bool $isNatural): int
    {
        return CleanIngredient::whereIn('id', $ingredientIds)
            ->update(['is_natural' => $isNatural]);
    }

    /**
     * Bulk update biodegradable status.
     */
    private function bulkUpdateBiodegradable(array $ingredientIds, bool $isBiodegradable): int
    {
        return CleanIngredient::whereIn('id', $ingredientIds)
            ->update(['is_biodegradable' => $isBiodegradable]);
    }

    /**
     * Generate export file.
     */
    private function generateExport($ingredients, string $format)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="ingredientes_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($ingredients) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, [
                'ID', 'Nombre', 'Nombre Químico', 'CAS', 'Tipo', 'Nivel Seguridad', 
                'Natural', 'Biodegradable', 'Productos', 'Concentración Min', 'Concentración Max', 
                'Símbolos Peligro', 'Creado'
            ]);

            // Data
            foreach ($ingredients as $ingredient) {
                fputcsv($file, [
                    $ingredient->id,
                    $ingredient->name,
                    $ingredient->chemical_name ?? 'N/A',
                    $ingredient->cas_number ?? 'N/A',
                    $ingredient->type,
                    $ingredient->safety_level,
                    $ingredient->is_natural ? 'Sí' : 'No',
                    $ingredient->is_biodegradable ? 'Sí' : 'No',
                    $ingredient->products_count ?? 0,
                    $ingredient->concentration_min ?? 'N/A',
                    $ingredient->concentration_max ?? 'N/A',
                    implode(', ', $ingredient->hazard_symbols ?? []),
                    $ingredient->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Bulk export ingredients.
     */
    private function bulkExport(array $ingredientIds)
    {
        $ingredients = CleanIngredient::withCount('products')
            ->whereIn('id', $ingredientIds)
            ->orderBy('name')
            ->get();

        return $this->generateExport($ingredients, 'csv');
    }
}