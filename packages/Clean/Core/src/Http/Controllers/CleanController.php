<?php

namespace Clean\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CleanController extends Controller
{
    /**
     * Display the main clean page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('clean-core::index');
    }
    
    /**
     * Display package information.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function info()
    {
        return response()->json([
            'package' => 'Clean Core',
            'version' => '1.0.0',
            'status' => 'active',
            'timestamp' => now()->toDateTimeString()
        ]);
    }
}