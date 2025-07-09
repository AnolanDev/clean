<?php

namespace Clean\Theme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Clean\Theme\Services\ThemeService;

class ThemeController extends Controller
{
    public function __construct(
        protected ThemeService $themeService
    ) {}

    /**
     * Display theme demo.
     */
    public function demo()
    {
        $config = $this->themeService->getThemeConfig();
        $components = $this->themeService->getComponentStyles();
        $icons = $this->themeService->getIcons();
        $utilities = $this->themeService->getUtilities();

        return view('clean-theme::demo', compact(
            'config', 'components', 'icons', 'utilities'
        ));
    }

    /**
     * Generate theme CSS.
     */
    public function generateCSS()
    {
        $css = $this->themeService->getCompleteCSS();

        return response($css, 200, [
            'Content-Type' => 'text/css',
            'Cache-Control' => 'max-age=3600',
        ]);
    }

    /**
     * Get theme configuration as JSON.
     */
    public function config()
    {
        return response()->json($this->themeService->getThemeConfig());
    }

    /**
     * Get theme assets information.
     */
    public function assets()
    {
        return response()->json($this->themeService->getAssets());
    }

    /**
     * Get theme icons.
     */
    public function icons()
    {
        return response()->json($this->themeService->getIcons());
    }

    /**
     * Display style guide.
     */
    public function styleGuide()
    {
        $config = $this->themeService->getThemeConfig();
        $components = $this->themeService->getComponentStyles();
        $icons = $this->themeService->getIcons();
        $utilities = $this->themeService->getUtilities();
        $breakpoints = $this->themeService->getBreakpoints();

        return view('clean-theme::style-guide', compact(
            'config', 'components', 'icons', 'utilities', 'breakpoints'
        ));
    }
}