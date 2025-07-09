<?php

namespace Clean\Catalog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Clean\Catalog\Services\CatalogService;
use Clean\Core\Repositories\CleanBrandRepository;
use Clean\Core\Repositories\CleanCategoryRepository;
use Clean\Core\Helpers\CleanConfigHelper;

class CatalogController extends Controller
{
    public function __construct(
        protected CatalogService $catalogService,
        protected CleanBrandRepository $brandRepository,
        protected CleanCategoryRepository $categoryRepository
    ) {}

    /**
     * Display catalog home page.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'eco_friendly', 'biodegradable', 'antibacterial', 'antiviral',
            'product_type', 'ph_level', 'safety_level', 'brand_id', 'category_id',
            'concentrated', 'usage_area', 'surface_type', 'search'
        ]);

        $products = $this->catalogService->getFilteredProducts($filters);
        $brands = $this->brandRepository->getActive();
        $categories = $this->categoryRepository->getRootCategories();
        $statistics = $this->catalogService->getCatalogStatistics();

        return view('clean-catalog::index', compact(
            'products', 'brands', 'categories', 'statistics', 'filters'
        ));
    }

    /**
     * Show product details.
     */
    public function show(int $productId)
    {
        $productData = $this->catalogService->getProductDetails($productId);
        $recommendations = $this->catalogService->getRecommendations($productData['product']);

        return view('clean-catalog::product', compact('productData', 'recommendations'));
    }

    /**
     * Show products by brand.
     */
    public function brand(string $brandSlug, Request $request)
    {
        $brand = $this->brandRepository->findBySlug($brandSlug);
        
        if (!$brand) {
            abort(404);
        }

        $filters = $request->only([
            'eco_friendly', 'biodegradable', 'antibacterial', 'antiviral',
            'product_type', 'ph_level', 'safety_level', 'category_id',
            'concentrated', 'usage_area', 'surface_type', 'search'
        ]);
        
        $filters['brand_id'] = $brand->id;

        $products = $this->catalogService->getFilteredProducts($filters);
        $categories = $this->categoryRepository->getActive();

        return view('clean-catalog::brand', compact(
            'brand', 'products', 'categories', 'filters'
        ));
    }

    /**
     * Show products by category.
     */
    public function category(string $categorySlug, Request $request)
    {
        $category = $this->categoryRepository->findBySlug($categorySlug);
        
        if (!$category) {
            abort(404);
        }

        $filters = $request->only([
            'eco_friendly', 'biodegradable', 'antibacterial', 'antiviral',
            'product_type', 'ph_level', 'safety_level', 'brand_id',
            'concentrated', 'surface_type', 'search'
        ]);
        
        $filters['category_id'] = $category->id;

        $products = $this->catalogService->getFilteredProducts($filters);
        $brands = $this->brandRepository->getActive();
        $childCategories = $this->categoryRepository->getChildren($category->id);

        return view('clean-catalog::category', compact(
            'category', 'products', 'brands', 'childCategories', 'filters'
        ));
    }

    /**
     * Search products.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        $filters = $request->only([
            'eco_friendly', 'biodegradable', 'antibacterial', 'antiviral',
            'product_type', 'ph_level', 'safety_level', 'brand_id', 'category_id',
            'concentrated', 'usage_area', 'surface_type'
        ]);

        $products = $this->catalogService->searchProducts($query, $filters);
        $brands = $this->brandRepository->getActive();
        $categories = $this->categoryRepository->getActive();

        return view('clean-catalog::search', compact(
            'products', 'brands', 'categories', 'query', 'filters'
        ));
    }

    /**
     * Get dilution calculator.
     */
    public function dilutionCalculator(Request $request)
    {
        $productId = $request->input('product_id');
        $volume = $request->input('volume', 1000);

        $result = $this->catalogService->calculateDilution($productId, $volume);

        return response()->json($result);
    }

    /**
     * Get coverage calculator.
     */
    public function coverageCalculator(Request $request)
    {
        $productId = $request->input('product_id');
        $amount = $request->input('amount', 1000);

        $result = $this->catalogService->calculateCoverage($productId, $amount);

        return response()->json($result);
    }

    /**
     * Compare products.
     */
    public function compare(Request $request)
    {
        $productIds = $request->input('products', []);
        
        if (count($productIds) < 2) {
            return redirect()->back()->with('error', 'Selecciona al menos 2 productos para comparar');
        }

        $comparison = $this->catalogService->compareProducts($productIds);

        return view('clean-catalog::compare', compact('comparison'));
    }

    /**
     * Get filters data for AJAX.
     */
    public function filtersData()
    {
        return response()->json([
            'brands' => $this->brandRepository->getActive(),
            'categories' => $this->categoryRepository->getActive(),
            'product_types' => $this->catalogService->getProductTypes(),
            'ph_levels' => $this->catalogService->getPhLevels(),
            'safety_levels' => $this->catalogService->getSafetyLevels(),
            'usage_areas' => $this->catalogService->getUsageAreas(),
            'surface_types' => $this->catalogService->getSurfaceTypes(),
        ]);
    }
}