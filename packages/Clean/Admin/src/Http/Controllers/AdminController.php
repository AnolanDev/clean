<?php

namespace Clean\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Clean\Admin\Services\AdminService;

class AdminController extends Controller
{
    public function __construct(
        protected AdminService $adminService
    ) {}

    /**
     * Display admin dashboard.
     */
    public function dashboard()
    {
        // Obtener estadísticas reales directamente de los modelos
        $totalProducts = \Clean\Core\Models\CleanProduct::count();
        $ecoProducts = \Clean\Core\Models\CleanProduct::where('is_eco_friendly', true)->count();
        $safeProducts = \Clean\Core\Models\CleanProduct::where('safety_classification', 'non_hazardous')->count();
        $hazardousProducts = \Clean\Core\Models\CleanProduct::where('safety_classification', 'hazardous')->count();
        
        $statistics = [
            'total_products' => $totalProducts,
            'eco_friendly_products' => $ecoProducts,
            'hazardous_products' => $hazardousProducts,
            'safe_products' => $safeProducts,
            'total_brands' => \Clean\Core\Models\CleanBrand::count(),
            'total_categories' => \Clean\Core\Models\CleanCategory::count(),
            'total_ingredients' => \Clean\Core\Models\CleanIngredient::count(),
            'hazardous_ingredients' => \Clean\Core\Models\CleanIngredient::where('safety_level', 'hazardous')->count(),
            'eco_percentage' => $totalProducts > 0 ? round(($ecoProducts / $totalProducts) * 100, 1) : 0,
            'safety_percentage' => $totalProducts > 0 ? round(($safeProducts / $totalProducts) * 100, 1) : 0,
        ];
        
        // Productos recientes
        $recentProducts = \Clean\Core\Models\CleanProduct::with(['brand', 'category'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();
            
        // Top marcas por número de productos
        $topBrands = \Clean\Core\Models\CleanBrand::withCount('products')
            ->orderByDesc('products_count')
            ->limit(5)
            ->get();
        
        // Alertas de seguridad básicas
        $safetyAlerts = [];
        if ($hazardousProducts > 0) {
            $safetyAlerts[] = [
                'message' => "Hay {$hazardousProducts} productos clasificados como peligrosos que requieren revisión.",
                'action' => 'Revisar productos peligrosos'
            ];
        }

        return view('clean-admin::dashboard', compact(
            'statistics', 'recentProducts', 'topBrands', 'safetyAlerts'
        ));
    }

    /**
     * Display products management.
     */
    public function products(Request $request)
    {
        $filters = $request->only([
            'brand_id', 'category_id', 'safety_level', 'eco_friendly',
            'search', 'sort_by', 'sort_order'
        ]);

        $products = $this->adminService->getProductsPaginated($filters);
        $brands = $this->adminService->getAllBrands();
        $categories = $this->adminService->getAllCategories();

        return view('clean-admin::products.index', compact(
            'products', 'brands', 'categories', 'filters'
        ));
    }

    /**
     * Display brands management.
     */
    public function brands(Request $request)
    {
        $filters = $request->only(['search', 'eco_friendly']);
        $brands = $this->adminService->getBrandsPaginated($filters);

        return view('clean-admin::brands.index', compact('brands', 'filters'));
    }

    /**
     * Display categories management.
     */
    public function categories(Request $request)
    {
        $categories = $this->adminService->getCategoriesTree();

        return view('clean-admin::categories.index', compact('categories'));
    }

    /**
     * Display ingredients management.
     */
    public function ingredients(Request $request)
    {
        $filters = $request->only(['type', 'safety_level', 'natural', 'search']);
        $ingredients = $this->adminService->getIngredientsPaginated($filters);

        return view('clean-admin::ingredients.index', compact('ingredients', 'filters'));
    }

    /**
     * Display safety reports.
     */
    public function safetyReports()
    {
        $reports = $this->adminService->getSafetyReports();
        $hazardousProducts = $this->adminService->getHazardousProducts();
        $safetyStatistics = $this->adminService->getSafetyStatistics();

        return view('clean-admin::safety.index', compact(
            'reports', 'hazardousProducts', 'safetyStatistics'
        ));
    }

    /**
     * Display analytics.
     */
    public function analytics()
    {
        $analytics = $this->adminService->getAnalytics();
        $productTrends = $this->adminService->getProductTrends();
        $brandPerformance = $this->adminService->getBrandPerformance();

        return view('clean-admin::analytics.index', compact(
            'analytics', 'productTrends', 'brandPerformance'
        ));
    }

    /**
     * Display settings.
     */
    public function settings()
    {
        $settings = $this->adminService->getSettings();

        return view('clean-admin::settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable'
        ]);

        $this->adminService->updateSettings($validated['settings']);

        return redirect()->route('admin.clean.settings')
            ->with('success', 'Configuración actualizada correctamente');
    }

    /**
     * Export products data.
     */
    public function exportProducts(Request $request)
    {
        $format = $request->input('format', 'csv');
        $filters = $request->only([
            'brand_id', 'category_id', 'safety_level', 'eco_friendly'
        ]);

        return $this->adminService->exportProducts($filters, $format);
    }

    /**
     * Generate safety report.
     */
    public function generateSafetyReport(Request $request)
    {
        $type = $request->input('type', 'full');
        
        return $this->adminService->generateSafetyReport($type);
    }

    /**
     * Bulk operations on products.
     */
    public function bulkOperation(Request $request)
    {
        $validated = $request->validate([
            'operation' => 'required|in:delete,update_safety,update_eco,export',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:clean_products,id',
            'data' => 'nullable|array'
        ]);

        $result = $this->adminService->bulkOperation(
            $validated['operation'],
            $validated['product_ids'],
            $validated['data'] ?? []
        );

        return response()->json($result);
    }

    /**
     * Get product suggestions for autocomplete.
     */
    public function productSuggestions(Request $request)
    {
        $query = $request->input('q');
        $suggestions = $this->adminService->getProductSuggestions($query);

        return response()->json($suggestions);
    }

    /**
     * Get ingredient safety info.
     */
    public function ingredientSafetyInfo(int $ingredientId)
    {
        $info = $this->adminService->getIngredientSafetyInfo($ingredientId);

        return response()->json($info);
    }
}