<?php

namespace Clean\Admin\Support;

class FilterConfig
{
    /**
     * Configuration for common filter patterns
     */
    public static function common(): array
    {
        return [
            'search' => [
                'type' => 'search',
                'columns' => ['name', 'description']
            ],
            'status' => [
                'type' => 'boolean',
                'column' => 'status'
            ],
            'is_active' => [
                'type' => 'boolean',
                'column' => 'is_active'
            ],
            'created_at' => [
                'type' => 'date',
                'column' => 'created_at'
            ],
            'updated_at' => [
                'type' => 'date',
                'column' => 'updated_at'
            ]
        ];
    }

    /**
     * Configuration for boolean filters
     */
    public static function boolean(string $column, string $label = null): array
    {
        return [
            'type' => 'boolean',
            'column' => $column,
            'label' => $label ?? ucwords(str_replace('_', ' ', $column))
        ];
    }

    /**
     * Configuration for search filters
     */
    public static function search(array $columns, string $label = 'Buscar'): array
    {
        return [
            'type' => 'search',
            'columns' => $columns,
            'label' => $label
        ];
    }

    /**
     * Configuration for relation filters
     */
    public static function relation(string $relation, string $column = 'id', string $label = null): array
    {
        return [
            'type' => 'relation',
            'relation' => $relation,
            'relation_column' => $column,
            'label' => $label ?? ucwords(str_replace('_', ' ', $relation))
        ];
    }

    /**
     * Configuration for enum filters
     */
    public static function enum(string $column, array $options, string $label = null): array
    {
        return [
            'type' => 'equals',
            'column' => $column,
            'options' => $options,
            'label' => $label ?? ucwords(str_replace('_', ' ', $column))
        ];
    }

    /**
     * Configuration for date filters
     */
    public static function date(string $column, string $operator = '=', string $label = null): array
    {
        return [
            'type' => 'date',
            'column' => $column,
            'operator' => $operator,
            'label' => $label ?? ucwords(str_replace('_', ' ', $column))
        ];
    }

    /**
     * Configuration for ingredients module
     */
    public static function ingredients(): array
    {
        return array_merge(self::common(), [
            'search' => [
                'type' => 'search',
                'columns' => ['name', 'chemical_name', 'cas_number', 'description']
            ],
            'type' => [
                'type' => 'equals',
                'column' => 'type'
            ],
            'safety_level' => [
                'type' => 'equals',
                'column' => 'safety_level'
            ],
            'is_natural' => [
                'type' => 'boolean',
                'column' => 'is_natural'
            ],
            'is_biodegradable' => [
                'type' => 'boolean',
                'column' => 'is_biodegradable'
            ]
        ]);
    }

    /**
     * Configuration for products module
     */
    public static function products(): array
    {
        return array_merge(self::common(), [
            'search' => [
                'type' => 'search',
                'columns' => ['name', 'description', 'benefits']
            ],
            'brand_id' => [
                'type' => 'relation',
                'relation' => 'brand',
                'relation_column' => 'id'
            ],
            'category_id' => [
                'type' => 'relation',
                'relation' => 'category',
                'relation_column' => 'id'
            ],
            'safety_level' => [
                'type' => 'equals',
                'column' => 'safety_classification'
            ],
            'product_type' => [
                'type' => 'equals',
                'column' => 'product_type'
            ],
            'eco_friendly' => [
                'type' => 'boolean',
                'column' => 'is_eco_friendly'
            ],
            'antibacterial' => [
                'type' => 'boolean',
                'column' => 'is_antibacterial'
            ],
            'antiviral' => [
                'type' => 'boolean',
                'column' => 'is_antiviral'
            ],
            'biodegradable' => [
                'type' => 'boolean',
                'column' => 'is_biodegradable'
            ],
            'food_contact_safe' => [
                'type' => 'boolean',
                'column' => 'food_contact_safe'
            ],
            'no_residue' => [
                'type' => 'boolean',
                'column' => 'no_residue'
            ],
            'fabric_safe' => [
                'type' => 'boolean',
                'column' => 'fabric_safe'
            ]
        ]);
    }

    /**
     * Configuration for categories module
     */
    public static function categories(): array
    {
        return array_merge(self::common(), [
            'search' => [
                'type' => 'search',
                'columns' => ['name', 'description', 'usage_area', 'surface_type']
            ],
            'usage_area' => [
                'type' => 'equals',
                'column' => 'usage_area'
            ],
            'surface_type' => [
                'type' => 'equals',
                'column' => 'surface_type'
            ],
            'parent_id' => [
                'type' => 'custom' // Special handling in controller
            ],
            'professional_use' => [
                'type' => 'boolean',
                'column' => 'professional_use'
            ],
            'status' => [
                'type' => 'boolean',
                'column' => 'status'
            ]
        ]);
    }

    /**
     * Configuration for clients module
     */
    public static function clients(): array
    {
        return array_merge(self::common(), [
            'industry_type' => [
                'type' => 'equals',
                'column' => 'industry_type'
            ],
            'client_type' => [
                'type' => 'equals',
                'column' => 'client_type'
            ],
            'risk_level' => [
                'type' => 'equals',
                'column' => 'risk_level'
            ],
            'search' => [
                'type' => 'search',
                'columns' => ['company_name', 'contact_name', 'contact_email', 'tax_id']
            ]
        ]);
    }

    /**
     * Configuration for brands module
     */
    public static function brands(): array
    {
        return array_merge(self::common(), [
            'search' => [
                'type' => 'search',
                'columns' => ['name', 'description', 'country']
            ],
            'country' => [
                'type' => 'equals',
                'column' => 'country'
            ],
            'eco_friendly' => [
                'type' => 'boolean',
                'column' => 'is_eco_friendly'
            ],
            'status' => [
                'type' => 'boolean',
                'column' => 'status'
            ]
        ]);
    }

    /**
     * Default sorting configuration
     */
    public static function defaultSorting(): array
    {
        return [
            'default_sort' => 'created_at',
            'default_order' => 'desc',
            'allowed_sorts' => ['created_at', 'updated_at', 'name', 'id']
        ];
    }

    /**
     * Display labels for common filters
     */
    public static function labels(): array
    {
        return [
            'search' => 'Buscar',
            'status' => 'Estado',
            'is_active' => 'Activo',
            'created_at' => 'Fecha creación',
            'updated_at' => 'Última actualización',
            'brand_id' => 'Marca',
            'category_id' => 'Categoría',
            'safety_level' => 'Nivel de seguridad',
            'product_type' => 'Tipo de producto',
            'is_eco_friendly' => 'Ecológico',
            'is_antibacterial' => 'Antibacterial',
            'is_antiviral' => 'Antiviral',
            'is_biodegradable' => 'Biodegradable',
            'food_contact_safe' => 'Seguro para alimentos',
            'no_residue' => 'Sin residuos',
            'fabric_safe' => 'Seguro para telas',
            'type' => 'Tipo',
            'is_natural' => 'Natural',
            'usage_area' => 'Área de uso',
            'surface_type' => 'Tipo de superficie',
            'parent_id' => 'Categoría padre',
            'professional_use' => 'Uso profesional',
            'industry_type' => 'Industria',
            'client_type' => 'Tipo de cliente',
            'risk_level' => 'Nivel de riesgo',
            'country' => 'País',
            'sort_by' => 'Ordenar por',
            'sort_order' => 'Orden'
        ];
    }

    /**
     * Display values for boolean and enum filters
     */
    public static function displayValues(): array
    {
        return [
            'status' => ['1' => 'Activo', '0' => 'Inactivo'],
            'is_active' => ['1' => 'Sí', '0' => 'No'],
            'is_eco_friendly' => ['1' => 'Sí', '0' => 'No'],
            'is_antibacterial' => ['1' => 'Sí', '0' => 'No'],
            'is_antiviral' => ['1' => 'Sí', '0' => 'No'],
            'is_biodegradable' => ['1' => 'Sí', '0' => 'No'],
            'food_contact_safe' => ['1' => 'Sí', '0' => 'No'],
            'no_residue' => ['1' => 'Sí', '0' => 'No'],
            'fabric_safe' => ['1' => 'Sí', '0' => 'No'],
            'is_natural' => ['1' => 'Sí', '0' => 'No'],
            'professional_use' => ['1' => 'Sí', '0' => 'No'],
            'safety_level' => [
                'low' => 'Bajo',
                'medium' => 'Medio',
                'high' => 'Alto',
                'hazardous' => 'Peligroso',
                'non_hazardous' => 'No peligroso',
                'irritant' => 'Irritante',
                'corrosive' => 'Corrosivo',
                'toxic' => 'Tóxico',
                'flammable' => 'Inflamable'
            ],
            'product_type' => [
                'liquid' => 'Líquido',
                'powder' => 'Polvo',
                'gel' => 'Gel',
                'spray' => 'Spray',
                'foam' => 'Espuma',
                'paste' => 'Pasta',
                'crystal' => 'Cristal'
            ],
            'client_type' => [
                'corporate' => 'Corporativo',
                'small_business' => 'Pequeña empresa',
                'government' => 'Gobierno',
                'institution' => 'Institución'
            ],
            'risk_level' => [
                'low' => 'Bajo',
                'medium' => 'Medio',
                'high' => 'Alto'
            ],
            'sort_order' => [
                'asc' => 'Ascendente',
                'desc' => 'Descendente'
            ]
        ];
    }
}