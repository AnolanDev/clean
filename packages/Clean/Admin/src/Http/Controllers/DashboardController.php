<?php

namespace Clean\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Clean\Core\Models\CleanProduct;
use Clean\Core\Models\CleanBrand;
use Clean\Core\Models\CleanCategory;
use Clean\Core\Models\CleanIngredient;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with real statistics
     */
    public function index()
    {
        // Estadísticas básicas
        $totalProducts = CleanProduct::count();
        $totalBrands = CleanBrand::count();
        $totalCategories = CleanCategory::count();
        $totalIngredients = CleanIngredient::count();

        // Estadísticas de productos por categorías principales
        $productsByCategory = CleanCategory::whereNull('parent_id')
            ->withCount('products')
            ->orderByDesc('products_count')
            ->limit(5)
            ->get();

        // Marcas más populares (por número de productos)
        $topBrands = CleanBrand::withCount('products')
            ->orderByDesc('products_count')
            ->limit(10)
            ->get();

        // Productos ecológicos
        $ecoProducts = CleanProduct::where('is_eco_friendly', true)->count();
        $ecoPercentage = $totalProducts > 0 ? round(($ecoProducts / $totalProducts) * 100, 1) : 0;

        // Productos biodegradables
        $biodegradableProducts = CleanProduct::where('is_biodegradable', true)->count();
        $biodegradablePercentage = $totalProducts > 0 ? round(($biodegradableProducts / $totalProducts) * 100, 1) : 0;

        // Productos por nivel de seguridad
        $safetyStats = [
            'safe' => CleanProduct::where('safety_classification', 'non_hazardous')->count(),
            'moderate' => CleanProduct::where('safety_classification', 'moderately_hazardous')->count(),
            'hazardous' => CleanProduct::where('safety_classification', 'hazardous')->count(),
        ];

        // Ingredientes por tipo
        $ingredientsByType = CleanIngredient::selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->orderByDesc('count')
            ->get();

        // Ingredientes por nivel de seguridad
        $ingredientsSafety = CleanIngredient::selectRaw('safety_level, COUNT(*) as count')
            ->groupBy('safety_level')
            ->get();

        // Categorías con más productos
        $categoriesWithProducts = CleanCategory::whereNotNull('parent_id')
            ->withCount('products')
            ->having('products_count', '>', 0)
            ->orderByDesc('products_count')
            ->limit(8)
            ->get();

        // Marcas eco-friendly
        $ecoFriendlyBrands = CleanBrand::where('is_eco_friendly', true)->count();
        $ecoFriendlyBrandsPercentage = $totalBrands > 0 ? round(($ecoFriendlyBrands / $totalBrands) * 100, 1) : 0;

        // Productos concentrados
        $concentratedProducts = CleanProduct::where('is_concentrated', true)->count();
        $concentratedPercentage = $totalProducts > 0 ? round(($concentratedProducts / $totalProducts) * 100, 1) : 0;

        // Productos antibacteriales/antivirales
        $antibacterialProducts = CleanProduct::where('is_antibacterial', true)->count();
        $antiviralProducts = CleanProduct::where('is_antiviral', true)->count();

        return view('clean-admin::dashboard.index', compact(
            'totalProducts',
            'totalBrands',
            'totalCategories',
            'totalIngredients',
            'productsByCategory',
            'topBrands',
            'ecoProducts',
            'ecoPercentage',
            'biodegradableProducts',
            'biodegradablePercentage',
            'safetyStats',
            'ingredientsByType',
            'ingredientsSafety',
            'categoriesWithProducts',
            'ecoFriendlyBrands',
            'ecoFriendlyBrandsPercentage',
            'concentratedProducts',
            'concentratedPercentage',
            'antibacterialProducts',
            'antiviralProducts'
        ));
    }

    /**
     * Get statistics for AJAX requests
     */
    public function getStats(Request $request)
    {
        $type = $request->get('type', 'overview');

        switch ($type) {
            case 'products':
                return response()->json([
                    'total' => CleanProduct::count(),
                    'eco_friendly' => CleanProduct::where('is_eco_friendly', true)->count(),
                    'biodegradable' => CleanProduct::where('is_biodegradable', true)->count(),
                    'concentrated' => CleanProduct::where('is_concentrated', true)->count(),
                    'antibacterial' => CleanProduct::where('is_antibacterial', true)->count(),
                    'antiviral' => CleanProduct::where('is_antiviral', true)->count(),
                ]);

            case 'brands':
                return response()->json([
                    'total' => CleanBrand::count(),
                    'eco_friendly' => CleanBrand::where('is_eco_friendly', true)->count(),
                    'top_brands' => CleanBrand::withCount('products')
                        ->orderByDesc('products_count')
                        ->limit(5)
                        ->get(['name', 'products_count'])
                ]);

            case 'categories':
                return response()->json([
                    'total' => CleanCategory::count(),
                    'main_categories' => CleanCategory::whereNull('parent_id')->count(),
                    'subcategories' => CleanCategory::whereNotNull('parent_id')->count(),
                    'by_products' => CleanCategory::withCount('products')
                        ->orderByDesc('products_count')
                        ->limit(5)
                        ->get(['name', 'products_count'])
                ]);

            case 'ingredients':
                return response()->json([
                    'total' => CleanIngredient::count(),
                    'natural' => CleanIngredient::where('is_natural', true)->count(),
                    'biodegradable' => CleanIngredient::where('is_biodegradable', true)->count(),
                    'by_safety' => CleanIngredient::selectRaw('safety_level, COUNT(*) as count')
                        ->groupBy('safety_level')
                        ->get(),
                    'by_type' => CleanIngredient::selectRaw('type, COUNT(*) as count')
                        ->groupBy('type')
                        ->get()
                ]);

            default:
                return response()->json([
                    'products' => CleanProduct::count(),
                    'brands' => CleanBrand::count(),
                    'categories' => CleanCategory::count(),
                    'ingredients' => CleanIngredient::count(),
                ]);
        }
    }

    /**
     * Export dashboard data
     */
    public function export(Request $request)
    {
        $type = $request->get('type', 'overview');
        
        // Aquí implementarías la lógica de exportación
        return response()->json([
            'message' => "Exportando datos de {$type}...",
            'file_url' => "#" // URL del archivo generado
        ]);
    }
}