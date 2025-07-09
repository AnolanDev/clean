<?php

namespace Clean\Core\Repositories;

use Clean\Core\Models\CleanIngredient;
use Illuminate\Database\Eloquent\Collection;

class CleanIngredientRepository extends BaseRepository
{
    /**
     * Create a new repository instance.
     */
    public function __construct(CleanIngredient $model)
    {
        parent::__construct($model);
    }

    /**
     * Get ingredients by type.
     */
    public function getByType(string $type): Collection
    {
        return $this->model->byType($type)->get();
    }

    /**
     * Get ingredients by safety level.
     */
    public function getBySafetyLevel(string $level): Collection
    {
        return $this->model->bySafetyLevel($level)->get();
    }

    /**
     * Get natural ingredients.
     */
    public function getNatural(): Collection
    {
        return $this->model->natural()->get();
    }

    /**
     * Get biodegradable ingredients.
     */
    public function getBiodegradable(): Collection
    {
        return $this->model->biodegradable()->get();
    }

    /**
     * Get safe ingredients.
     */
    public function getSafe(): Collection
    {
        return $this->model->safe()->get();
    }

    /**
     * Get hazardous ingredients.
     */
    public function getHazardous(): Collection
    {
        return $this->model->hazardous()->get();
    }

    /**
     * Find ingredient by CAS number.
     */
    public function findByCasNumber(string $casNumber): ?CleanIngredient
    {
        return $this->model->where('cas_number', $casNumber)->first();
    }

    /**
     * Search ingredients by name.
     */
    public function searchByName(string $name): Collection
    {
        return $this->model->where('name', 'LIKE', "%{$name}%")
            ->orWhere('chemical_name', 'LIKE', "%{$name}%")
            ->get();
    }

    /**
     * Get ingredients with product count.
     */
    public function getWithProductCount(): Collection
    {
        return $this->model->withCount('products')
            ->orderBy('products_count', 'desc')
            ->get();
    }

    /**
     * Get ingredients by concentration range.
     */
    public function getByConcentrationRange(float $min, float $max): Collection
    {
        return $this->model->where('concentration_min', '>=', $min)
            ->where('concentration_max', '<=', $max)
            ->get();
    }

    /**
     * Get ingredients with hazard symbols.
     */
    public function getWithHazardSymbols(): Collection
    {
        return $this->model->whereNotNull('hazard_symbols')
            ->where('hazard_symbols', '!=', '[]')
            ->get();
    }

    /**
     * Get ingredients without hazard symbols.
     */
    public function getWithoutHazardSymbols(): Collection
    {
        return $this->model->where(function ($query) {
            $query->whereNull('hazard_symbols')
                ->orWhere('hazard_symbols', '[]');
        })->get();
    }

    /**
     * Get surfactants.
     */
    public function getSurfactants(): Collection
    {
        return $this->model->byType('surfactant')->get();
    }

    /**
     * Get disinfectants.
     */
    public function getDisinfectants(): Collection
    {
        return $this->model->byType('disinfectant')->get();
    }

    /**
     * Get preservatives.
     */
    public function getPreservatives(): Collection
    {
        return $this->model->byType('preservative')->get();
    }

    /**
     * Get fragrances.
     */
    public function getFragrances(): Collection
    {
        return $this->model->byType('fragrance')->get();
    }

    /**
     * Get enzymes.
     */
    public function getEnzymes(): Collection
    {
        return $this->model->byType('enzyme')->get();
    }

    /**
     * Filter ingredients by multiple criteria.
     */
    public function filterIngredients(array $filters): Collection
    {
        $query = $this->model->query();

        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (isset($filters['safety_level'])) {
            $query->where('safety_level', $filters['safety_level']);
        }

        if (isset($filters['is_natural'])) {
            $query->where('is_natural', $filters['is_natural']);
        }

        if (isset($filters['is_biodegradable'])) {
            $query->where('is_biodegradable', $filters['is_biodegradable']);
        }

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('chemical_name', 'LIKE', "%{$search}%")
                  ->orWhere('cas_number', 'LIKE', "%{$search}%");
            });
        }

        return $query->get();
    }

    /**
     * Get ingredient statistics.
     */
    public function getStatistics(): array
    {
        $total = $this->model->count();
        $natural = $this->model->natural()->count();
        $biodegradable = $this->model->biodegradable()->count();
        $safe = $this->model->safe()->count();
        $hazardous = $this->model->hazardous()->count();

        $byType = $this->model->selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->get()
            ->pluck('count', 'type')
            ->toArray();

        $bySafetyLevel = $this->model->selectRaw('safety_level, COUNT(*) as count')
            ->groupBy('safety_level')
            ->get()
            ->pluck('count', 'safety_level')
            ->toArray();

        return [
            'total' => $total,
            'natural' => $natural,
            'biodegradable' => $biodegradable,
            'safe' => $safe,
            'hazardous' => $hazardous,
            'by_type' => $byType,
            'by_safety_level' => $bySafetyLevel,
        ];
    }
}