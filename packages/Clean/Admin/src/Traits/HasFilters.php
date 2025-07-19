<?php

namespace Clean\Admin\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    /**
     * Apply filters to a query builder
     */
    protected function applyFilters(Builder $query, array $filters, array $config = []): Builder
    {
        foreach ($filters as $key => $value) {
            if (empty($value) && $value !== '0') {
                continue;
            }

            $filterMethod = $this->getFilterMethod($key);
            
            if (method_exists($this, $filterMethod)) {
                $query = $this->$filterMethod($query, $value, $filters);
            } elseif (isset($config[$key])) {
                $query = $this->applyConfigFilter($query, $key, $value, $config[$key]);
            }
        }

        return $query;
    }

    /**
     * Get the filter method name for a given key
     */
    protected function getFilterMethod(string $key): string
    {
        return 'filter' . str_replace('_', '', ucwords($key, '_'));
    }

    /**
     * Apply a filter based on configuration
     */
    protected function applyConfigFilter(Builder $query, string $key, $value, array $config): Builder
    {
        $type = $config['type'] ?? 'equals';
        $column = $config['column'] ?? $key;
        $table = $config['table'] ?? null;

        $fullColumn = $table ? "{$table}.{$column}" : $column;

        switch ($type) {
            case 'search':
                $columns = $config['columns'] ?? [$column];
                $query->where(function($subQuery) use ($columns, $value, $table) {
                    foreach ($columns as $searchColumn) {
                        $fullSearchColumn = $table ? "{$table}.{$searchColumn}" : $searchColumn;
                        $subQuery->orWhere($fullSearchColumn, 'like', "%{$value}%");
                    }
                });
                break;

            case 'equals':
                $query->where($fullColumn, $value);
                break;

            case 'boolean':
                // Manejar correctamente valores de string para booleanos
                $boolValue = $value === '1' || $value === 1 || $value === true;
                $query->where($fullColumn, $boolValue);
                break;

            case 'range':
                if (isset($config['min_column']) && isset($config['max_column'])) {
                    $minColumn = $table ? "{$table}.{$config['min_column']}" : $config['min_column'];
                    $maxColumn = $table ? "{$table}.{$config['max_column']}" : $config['max_column'];
                    $query->whereBetween($fullColumn, [$minColumn, $maxColumn]);
                }
                break;

            case 'in':
                $values = is_array($value) ? $value : explode(',', $value);
                $query->whereIn($fullColumn, $values);
                break;

            case 'relation':
                $relation = $config['relation'];
                $relationColumn = $config['relation_column'] ?? 'id';
                $query->whereHas($relation, function($relationQuery) use ($relationColumn, $value) {
                    $relationQuery->where($relationColumn, $value);
                });
                break;

            case 'date':
                if (isset($config['operator'])) {
                    $query->whereDate($fullColumn, $config['operator'], $value);
                } else {
                    $query->whereDate($fullColumn, $value);
                }
                break;

            case 'null':
                if ($value === '1' || $value === 1) {
                    $query->whereNull($fullColumn);
                } else {
                    $query->whereNotNull($fullColumn);
                }
                break;
        }

        return $query;
    }

    /**
     * Apply sorting to the query
     */
    protected function applySorting(Builder $query, array $filters, array $config = []): Builder
    {
        $sortBy = $filters['sort_by'] ?? ($config['default_sort'] ?? 'created_at');
        $sortOrder = $filters['sort_order'] ?? ($config['default_order'] ?? 'desc');

        // Validar que el campo de ordenamiento esté permitido
        $allowedSorts = $config['allowed_sorts'] ?? ['created_at', 'updated_at', 'name'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = $config['default_sort'] ?? 'created_at';
        }

        $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'desc';

        return $query->orderBy($sortBy, $sortOrder);
    }

    /**
     * Get filter indicators for display
     */
    protected function getFilterIndicators(array $filters, array $config = []): array
    {
        $indicators = [];
        
        foreach ($filters as $key => $value) {
            if (empty($value) && $value !== '0') {
                continue;
            }

            $label = $config['labels'][$key] ?? ucwords(str_replace('_', ' ', $key));
            $displayValue = $this->getFilterDisplayValue($key, $value, $config);
            
            $indicators[] = [
                'key' => $key,
                'label' => $label,
                'value' => $displayValue,
                'raw_value' => $value
            ];
        }

        return $indicators;
    }

    /**
     * Get display value for a filter
     */
    protected function getFilterDisplayValue(string $key, $value, array $config = []): string
    {
        if (isset($config['display_values'][$key][$value])) {
            return $config['display_values'][$key][$value];
        }

        if (isset($config['display_callbacks'][$key])) {
            return call_user_func($config['display_callbacks'][$key], $value);
        }

        // Default display logic
        if (is_bool($value) || $value === '0' || $value === '1') {
            return $value ? 'Sí' : 'No';
        }

        return (string) $value;
    }

    /**
     * Build pagination with query string
     */
    protected function paginateWithFilters(Builder $query, int $perPage = 20)
    {
        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * Count active filters
     */
    protected function countActiveFilters(array $filters): int
    {
        return collect($filters)->filter(function($value) {
            return !empty($value) || $value === '0';
        })->count();
    }

    /**
     * Default search filter
     */
    protected function filterSearch(Builder $query, string $search, array $filters): Builder
    {
        // Default search implementation - override in controllers as needed
        return $query->where(function($subQuery) use ($search) {
            $subQuery->where('name', 'like', "%{$search}%")
                     ->orWhere('description', 'like', "%{$search}%");
        });
    }

    /**
     * Default boolean filter
     */
    protected function filterBoolean(Builder $query, string $field, $value): Builder
    {
        return $query->where($field, (bool)$value);
    }

    /**
     * Default status filter
     */
    protected function filterStatus(Builder $query, $status, array $filters): Builder
    {
        return $query->where('status', (bool)$status);
    }

    /**
     * Default active filter
     */
    protected function filterIsActive(Builder $query, $active, array $filters): Builder
    {
        return $query->where('is_active', (bool)$active);
    }
}