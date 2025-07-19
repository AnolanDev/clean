<?php

namespace Clean\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Clean\Core\Models\CleanClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Clean\Admin\Traits\HasFilters;
use Clean\Admin\Support\FilterConfig;

class ClientController extends Controller
{
    use HasFilters;
    /**
     * Display a listing of clients.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'search', 'industry_type', 'client_type', 'risk_level', 
            'is_active', 'sort_by', 'sort_order'
        ]);

        // Construir query base
        $query = CleanClient::query();
        
        // Aplicar filtros usando el trait HasFilters
        $filterConfig = FilterConfig::clients();
        $query = $this->applyFilters($query, $filters, $filterConfig);

        $sortBy = $filters['sort_by'] ?? 'company_name';
        $sortOrder = $filters['sort_order'] ?? 'asc';
        
        $clients = $query->orderBy($sortBy, $sortOrder)->paginate(20);

        $stats = [
            'total' => CleanClient::count(),
            'active' => CleanClient::where('is_active', true)->count(),
            'high_value' => CleanClient::where('total_purchases', '>=', 10000)->count(),
            'needs_attention' => CleanClient::query()->needsAttention()->count(),
        ];

        return view('clean-admin::clients.index', compact('clients', 'stats', 'filters'));
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('clean-admin::clients.create');
    }

    /**
     * Store a newly created client in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|unique:clean_clients,contact_email',
            'contact_phone' => 'nullable|string|max:20',
            'secondary_phone' => 'nullable|string|max:20',
            'tax_id' => 'nullable|string|max:50|unique:clean_clients,tax_id',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'industry_type' => 'required|in:hospitality,healthcare,education,office,retail,restaurant,manufacturing,government,other',
            'client_type' => 'required|in:corporate,small_business,government,institution',
            'credit_limit' => 'nullable|numeric|min:0',
            'payment_terms' => 'nullable|integer|min:1|max:365',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'acquisition_date' => 'nullable|date',
            'preferred_contact_method' => 'required|in:email,phone,whatsapp,in_person',
            'delivery_instructions' => 'nullable|string',
            'account_manager' => 'nullable|string|max:255',
            'risk_level' => 'required|in:low,medium,high',
            'certifications_required' => 'nullable|array',
            'cleaning_frequency' => 'required|in:daily,weekly,bi_weekly,monthly,as_needed',
            'facility_size' => 'nullable|integer|min:1',
            'number_of_employees' => 'nullable|integer|min:1',
        ]);

        CleanClient::create($validated);

        return redirect()
            ->route('admin.clean.clients.index')
            ->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified client.
     */
    public function show(CleanClient $cleanClient)
    {
        $cleanClient->load('orders');
        
        return view('clean-admin::clients.show', compact('cleanClient'));
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit(CleanClient $cleanClient)
    {
        return view('clean-admin::clients.edit', compact('cleanClient'));
    }

    /**
     * Update the specified client in storage.
     */
    public function update(Request $request, CleanClient $cleanClient)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_email' => [
                'required',
                'email',
                Rule::unique('clean_clients', 'contact_email')->ignore($cleanClient->id)
            ],
            'contact_phone' => 'nullable|string|max:20',
            'secondary_phone' => 'nullable|string|max:20',
            'tax_id' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('clean_clients', 'tax_id')->ignore($cleanClient->id)
            ],
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'industry_type' => 'required|in:hospitality,healthcare,education,office,retail,restaurant,manufacturing,government,other',
            'client_type' => 'required|in:corporate,small_business,government,institution',
            'credit_limit' => 'nullable|numeric|min:0',
            'payment_terms' => 'nullable|integer|min:1|max:365',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'boolean',
            'notes' => 'nullable|string',
            'acquisition_date' => 'nullable|date',
            'last_purchase_date' => 'nullable|date',
            'total_purchases' => 'nullable|numeric|min:0',
            'preferred_contact_method' => 'required|in:email,phone,whatsapp,in_person',
            'delivery_instructions' => 'nullable|string',
            'account_manager' => 'nullable|string|max:255',
            'risk_level' => 'required|in:low,medium,high',
            'certifications_required' => 'nullable|array',
            'cleaning_frequency' => 'required|in:daily,weekly,bi_weekly,monthly,as_needed',
            'facility_size' => 'nullable|integer|min:1',
            'number_of_employees' => 'nullable|integer|min:1',
        ]);

        $cleanClient->update($validated);

        return redirect()
            ->route('admin.clean.clients.index')
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified client from storage.
     */
    public function destroy(CleanClient $cleanClient)
    {
        // Verificar si tiene órdenes relacionadas
        if ($cleanClient->orders()->exists()) {
            return redirect()
                ->route('admin.clean.clients.index')
                ->with('error', 'No se puede eliminar el cliente porque tiene órdenes asociadas.');
        }

        $cleanClient->delete();

        return redirect()
            ->route('admin.clean.clients.index')
            ->with('success', 'Cliente eliminado exitosamente.');
    }

    /**
     * Handle bulk actions on multiple clients.
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete,update_risk',
            'client_ids' => 'required|array|min:1',
            'client_ids.*' => 'exists:clean_clients,id',
            'risk_level' => 'required_if:action,update_risk|in:low,medium,high',
        ]);

        $clientIds = $request->client_ids;
        $count = 0;

        DB::transaction(function () use ($request, $clientIds, &$count) {
            switch ($request->action) {
                case 'activate':
                    $count = CleanClient::whereIn('id', $clientIds)
                        ->update(['is_active' => true]);
                    break;

                case 'deactivate':
                    $count = CleanClient::whereIn('id', $clientIds)
                        ->update(['is_active' => false]);
                    break;

                case 'update_risk':
                    $count = CleanClient::whereIn('id', $clientIds)
                        ->update(['risk_level' => $request->risk_level]);
                    break;

                case 'delete':
                    // Solo eliminar clientes sin órdenes
                    $clients = CleanClient::whereIn('id', $clientIds)
                        ->doesntHave('orders')
                        ->get();
                    
                    foreach ($clients as $client) {
                        $client->delete();
                        $count++;
                    }
                    break;
            }
        });

        $action = match ($request->action) {
            'activate' => 'activados',
            'deactivate' => 'desactivados',
            'update_risk' => 'actualizados',
            'delete' => 'eliminados',
        };

        return redirect()
            ->route('admin.clean.clients.index')
            ->with('success', "{$count} clientes {$action} exitosamente.");
    }

    /**
     * Export clients data.
     */
    public function export(Request $request)
    {
        $filters = $request->only([
            'search', 'industry_type', 'client_type', 'risk_level', 'is_active'
        ]);

        $query = CleanClient::query()
            ->when($filters['search'] ?? null, fn($q, $search) => 
                $q->where(function($subQ) use ($search) {
                    $subQ->where('company_name', 'like', "%{$search}%")
                         ->orWhere('contact_name', 'like', "%{$search}%")
                         ->orWhere('contact_email', 'like', "%{$search}%");
                }))
            ->when($filters['industry_type'] ?? null, fn($q, $industry) => 
                $q->where('industry_type', $industry))
            ->when($filters['client_type'] ?? null, fn($q, $type) => 
                $q->where('client_type', $type))
            ->when($filters['risk_level'] ?? null, fn($q, $risk) => 
                $q->where('risk_level', $risk))
            ->when(isset($filters['is_active']), fn($q) => 
                $q->where('is_active', $filters['is_active']));

        $clients = $query->orderBy('company_name')->get();

        $csvData = [];
        $csvData[] = [
            'Empresa', 'Contacto', 'Email', 'Teléfono', 'Industria', 
            'Tipo Cliente', 'Estado', 'Nivel Riesgo', 'Compras Totales', 
            'Límite Crédito', 'Fecha Adquisición'
        ];

        foreach ($clients as $client) {
            $csvData[] = [
                $client->company_name,
                $client->contact_name,
                $client->contact_email,
                $client->contact_phone,
                $client->getIndustryInfo()['label'],
                ucfirst($client->client_type),
                $client->is_active ? 'Activo' : 'Inactivo',
                $client->getRiskLevelInfo()['label'],
                $client->getFormattedTotalPurchases(),
                $client->getFormattedCreditLimit(),
                $client->acquisition_date?->format('d/m/Y') ?? 'N/A'
            ];
        }

        $filename = 'clientes_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get client information for AJAX requests.
     */
    public function clientInfo(CleanClient $cleanClient)
    {
        $client = $cleanClient->load('orders');
        
        return response()->json([
            'client' => $client,
            'stats' => [
                'orders_count' => $client->orders->count(),
                'recent_orders' => $client->orders()
                    ->latest()
                    ->limit(5)
                    ->get(),
                'risk_info' => $client->getRiskLevelInfo(),
                'industry_info' => $client->getIndustryInfo(),
                'is_high_value' => $client->isHighValue(),
                'needs_attention' => $client->needsAttention(),
            ]
        ]);
    }
}