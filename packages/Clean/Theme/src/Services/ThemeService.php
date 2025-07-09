<?php

namespace Clean\Theme\Services;

class ThemeService
{
    /**
     * Get theme configuration.
     */
    public function getThemeConfig(): array
    {
        return [
            'name' => 'Clean Theme',
            'version' => '1.0.0',
            'description' => 'Tema personalizado para productos de limpieza',
            'author' => 'Clean Team',
            'colors' => [
                'primary' => '#667eea',
                'secondary' => '#764ba2',
                'success' => '#48bb78',
                'warning' => '#ed8936',
                'danger' => '#f56565',
                'info' => '#4299e1',
                'light' => '#f7fafc',
                'dark' => '#2d3748',
            ],
            'fonts' => [
                'primary' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif',
                'secondary' => 'Georgia, serif',
                'monospace' => '"Fira Code", "Courier New", monospace',
            ]
        ];
    }

    /**
     * Get theme assets.
     */
    public function getAssets(): array
    {
        return [
            'css' => [
                'main' => '/themes/clean/css/main.css',
                'components' => '/themes/clean/css/components.css',
                'responsive' => '/themes/clean/css/responsive.css',
            ],
            'js' => [
                'main' => '/themes/clean/js/main.js',
                'components' => '/themes/clean/js/components.js',
                'filters' => '/themes/clean/js/filters.js',
            ],
            'images' => [
                'logo' => '/themes/clean/images/logo.png',
                'placeholder' => '/themes/clean/images/placeholder.png',
            ]
        ];
    }

    /**
     * Get component styles.
     */
    public function getComponentStyles(): array
    {
        return [
            'product-card' => [
                'background' => 'white',
                'border-radius' => '10px',
                'box-shadow' => '0 2px 10px rgba(0,0,0,0.1)',
                'padding' => '1.5rem',
                'transition' => 'transform 0.2s ease',
            ],
            'safety-badge' => [
                'padding' => '0.25rem 0.5rem',
                'border-radius' => '12px',
                'font-size' => '0.75rem',
                'font-weight' => '500',
                'colors' => [
                    'safe' => ['background' => '#f0fff4', 'color' => '#22543d'],
                    'warning' => ['background' => '#fffbeb', 'color' => '#744210'],
                    'danger' => ['background' => '#fed7d7', 'color' => '#742a2a'],
                ]
            ],
            'eco-badge' => [
                'background' => '#f0fff4',
                'color' => '#22543d',
                'padding' => '0.25rem 0.5rem',
                'border-radius' => '12px',
                'font-size' => '0.75rem',
                'font-weight' => '500',
            ]
        ];
    }

    /**
     * Generate CSS for theme.
     */
    public function generateCSS(): string
    {
        $config = $this->getThemeConfig();
        $components = $this->getComponentStyles();
        
        $css = ":root {\n";
        
        // Add CSS variables for colors
        foreach ($config['colors'] as $name => $color) {
            $css .= "  --color-{$name}: {$color};\n";
        }
        
        // Add CSS variables for fonts
        foreach ($config['fonts'] as $name => $font) {
            $css .= "  --font-{$name}: {$font};\n";
        }
        
        $css .= "}\n\n";
        
        // Add component styles
        foreach ($components as $component => $styles) {
            $css .= $this->generateComponentCSS($component, $styles);
        }
        
        return $css;
    }

    /**
     * Generate component CSS.
     */
    protected function generateComponentCSS(string $component, array $styles): string
    {
        $css = ".{$component} {\n";
        
        foreach ($styles as $property => $value) {
            if ($property === 'colors') {
                // Handle nested color properties
                foreach ($value as $variant => $colors) {
                    $css .= "}\n\n.{$component}.{$variant} {\n";
                    foreach ($colors as $prop => $color) {
                        $css .= "  {$prop}: {$color};\n";
                    }
                }
            } else {
                $css .= "  {$property}: {$value};\n";
            }
        }
        
        $css .= "}\n\n";
        
        return $css;
    }

    /**
     * Get theme icons.
     */
    public function getIcons(): array
    {
        return [
            'product-types' => [
                'liquid' => '🧴',
                'powder' => '📦',
                'gel' => '🫧',
                'foam' => '🧽',
                'spray' => '🏷️',
                'wipes' => '🧻',
                'concentrate' => '💧',
                'paste' => '🥄',
                'granules' => '🔸',
                'tablet' => '💊',
            ],
            'categories' => [
                'kitchen' => '🍳',
                'bathroom' => '🚿',
                'floor' => '🧽',
                'glass' => '🪟',
                'furniture' => '🪑',
                'laundry' => '👕',
                'dishwash' => '🍽️',
                'multi_purpose' => '🧹',
                'industrial' => '🏭',
            ],
            'features' => [
                'eco_friendly' => '🌿',
                'antibacterial' => '🦠',
                'antiviral' => '🛡️',
                'biodegradable' => '♻️',
                'concentrated' => '💧',
                'natural' => '🌱',
                'safe' => '✅',
                'warning' => '⚠️',
                'danger' => '🚨',
            ],
            'actions' => [
                'search' => '🔍',
                'filter' => '🔧',
                'compare' => '⚖️',
                'export' => '📥',
                'settings' => '⚙️',
                'analytics' => '📊',
                'safety' => '🛡️',
                'report' => '📋',
            ]
        ];
    }

    /**
     * Get responsive breakpoints.
     */
    public function getBreakpoints(): array
    {
        return [
            'mobile' => '480px',
            'tablet' => '768px',
            'desktop' => '1024px',
            'large' => '1200px',
            'xlarge' => '1400px',
        ];
    }

    /**
     * Generate responsive CSS.
     */
    public function generateResponsiveCSS(): string
    {
        $breakpoints = $this->getBreakpoints();
        
        $css = '';
        
        // Mobile-first approach
        $css .= "@media (max-width: {$breakpoints['mobile']}) {\n";
        $css .= "  .stats-grid { grid-template-columns: 1fr; }\n";
        $css .= "  .products-grid { grid-template-columns: 1fr; }\n";
        $css .= "  .dashboard-grid { grid-template-columns: 1fr; }\n";
        $css .= "  .filter-grid { grid-template-columns: 1fr; }\n";
        $css .= "  .header-content { flex-direction: column; gap: 1rem; }\n";
        $css .= "  .search-bar { max-width: 100%; }\n";
        $css .= "}\n\n";
        
        $css .= "@media (max-width: {$breakpoints['tablet']}) {\n";
        $css .= "  .stats-grid { grid-template-columns: repeat(2, 1fr); }\n";
        $css .= "  .products-grid { grid-template-columns: repeat(2, 1fr); }\n";
        $css .= "  .categories-grid { grid-template-columns: repeat(2, 1fr); }\n";
        $css .= "  .nav-links { flex-direction: column; gap: 0.5rem; }\n";
        $css .= "}\n\n";
        
        $css .= "@media (min-width: {$breakpoints['desktop']}) {\n";
        $css .= "  .stats-grid { grid-template-columns: repeat(4, 1fr); }\n";
        $css .= "  .products-grid { grid-template-columns: repeat(3, 1fr); }\n";
        $css .= "  .categories-grid { grid-template-columns: repeat(3, 1fr); }\n";
        $css .= "}\n\n";
        
        $css .= "@media (min-width: {$breakpoints['large']}) {\n";
        $css .= "  .products-grid { grid-template-columns: repeat(4, 1fr); }\n";
        $css .= "  .categories-grid { grid-template-columns: repeat(4, 1fr); }\n";
        $css .= "}\n\n";
        
        return $css;
    }

    /**
     * Get theme utilities.
     */
    public function getUtilities(): array
    {
        return [
            'spacing' => [
                'xs' => '0.25rem',
                'sm' => '0.5rem',
                'md' => '1rem',
                'lg' => '1.5rem',
                'xl' => '2rem',
                'xxl' => '3rem',
            ],
            'shadows' => [
                'sm' => '0 1px 3px rgba(0,0,0,0.1)',
                'md' => '0 2px 10px rgba(0,0,0,0.1)',
                'lg' => '0 4px 20px rgba(0,0,0,0.1)',
                'xl' => '0 8px 40px rgba(0,0,0,0.1)',
            ],
            'transitions' => [
                'fast' => '0.1s ease',
                'normal' => '0.2s ease',
                'slow' => '0.3s ease',
            ],
            'border-radius' => [
                'sm' => '3px',
                'md' => '5px',
                'lg' => '8px',
                'xl' => '12px',
                'full' => '50%',
            ]
        ];
    }

    /**
     * Generate utility CSS.
     */
    public function generateUtilityCSS(): string
    {
        $utilities = $this->getUtilities();
        $css = '';
        
        // Generate spacing utilities
        foreach ($utilities['spacing'] as $name => $value) {
            $css .= ".m-{$name} { margin: {$value}; }\n";
            $css .= ".p-{$name} { padding: {$value}; }\n";
            $css .= ".mt-{$name} { margin-top: {$value}; }\n";
            $css .= ".mb-{$name} { margin-bottom: {$value}; }\n";
            $css .= ".ml-{$name} { margin-left: {$value}; }\n";
            $css .= ".mr-{$name} { margin-right: {$value}; }\n";
            $css .= ".pt-{$name} { padding-top: {$value}; }\n";
            $css .= ".pb-{$name} { padding-bottom: {$value}; }\n";
            $css .= ".pl-{$name} { padding-left: {$value}; }\n";
            $css .= ".pr-{$name} { padding-right: {$value}; }\n";
        }
        
        // Generate shadow utilities
        foreach ($utilities['shadows'] as $name => $value) {
            $css .= ".shadow-{$name} { box-shadow: {$value}; }\n";
        }
        
        // Generate border-radius utilities
        foreach ($utilities['border-radius'] as $name => $value) {
            $css .= ".rounded-{$name} { border-radius: {$value}; }\n";
        }
        
        return $css;
    }

    /**
     * Get complete theme CSS.
     */
    public function getCompleteCSS(): string
    {
        $css = "/* Clean Theme CSS */\n\n";
        $css .= $this->generateCSS();
        $css .= $this->generateResponsiveCSS();
        $css .= $this->generateUtilityCSS();
        
        return $css;
    }
}