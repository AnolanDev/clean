<?php

namespace Clean\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class CleanClient extends Model
{
    protected $fillable = [
        'company_name',
        'contact_name',
        'contact_email',
        'contact_phone',
        'secondary_phone',
        'tax_id',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'website',
        'industry_type',
        'client_type',
        'credit_limit',
        'payment_terms',
        'discount_percentage',
        'is_active',
        'notes',
        'acquisition_date',
        'last_purchase_date',
        'total_purchases',
        'preferred_contact_method',
        'delivery_instructions',
        'account_manager',
        'risk_level',
        'certifications_required',
        'cleaning_frequency',
        'facility_size',
        'number_of_employees'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'credit_limit' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'total_purchases' => 'decimal:2',
        'acquisition_date' => 'date',
        'last_purchase_date' => 'date',
        'certifications_required' => 'json',
        'facility_size' => 'integer',
        'number_of_employees' => 'integer'
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * Get the client company name.
     */
    public function getCompanyName(): string
    {
        return $this->company_name;
    }

    /**
     * Get the primary contact name.
     */
    public function getContactName(): string
    {
        return $this->contact_name;
    }

    /**
     * Get the contact email.
     */
    public function getContactEmail(): string
    {
        return $this->contact_email;
    }

    /**
     * Check if the client is active.
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Get the client type.
     */
    public function getClientType(): string
    {
        return $this->client_type;
    }

    /**
     * Get the industry type.
     */
    public function getIndustryType(): string
    {
        return $this->industry_type;
    }

    /**
     * Get formatted credit limit.
     */
    public function getFormattedCreditLimit(): string
    {
        return '$' . number_format($this->credit_limit, 2);
    }

    /**
     * Get formatted total purchases.
     */
    public function getFormattedTotalPurchases(): string
    {
        return '$' . number_format($this->total_purchases, 2);
    }

    /**
     * Get full address.
     */
    public function getFullAddress(): string
    {
        return trim("{$this->address}, {$this->city}, {$this->state} {$this->postal_code}, {$this->country}");
    }

    /**
     * Check if client is high value (based on total purchases).
     */
    public function isHighValue(): bool
    {
        return $this->total_purchases >= 10000;
    }

    /**
     * Check if client needs attention (no recent purchases).
     */
    public function needsAttention(): bool
    {
        if (!$this->last_purchase_date) {
            return true;
        }
        
        return $this->last_purchase_date->diffInMonths(now()) > 6;
    }

    /**
     * Get risk level with color coding.
     */
    public function getRiskLevelInfo(): array
    {
        $levels = [
            'low' => ['color' => 'green', 'label' => 'Bajo Riesgo'],
            'medium' => ['color' => 'yellow', 'label' => 'Riesgo Medio'],
            'high' => ['color' => 'red', 'label' => 'Alto Riesgo']
        ];

        return $levels[$this->risk_level] ?? $levels['medium'];
    }

    /**
     * Get industry type with icon.
     */
    public function getIndustryInfo(): array
    {
        $industries = [
            'hospitality' => ['icon' => '🏨', 'label' => 'Hotelería'],
            'healthcare' => ['icon' => '🏥', 'label' => 'Salud'],
            'education' => ['icon' => '🏫', 'label' => 'Educación'],
            'office' => ['icon' => '🏢', 'label' => 'Oficinas'],
            'retail' => ['icon' => '🏪', 'label' => 'Retail'],
            'restaurant' => ['icon' => '🍽️', 'label' => 'Restaurantes'],
            'manufacturing' => ['icon' => '🏭', 'label' => 'Manufactura'],
            'government' => ['icon' => '🏛️', 'label' => 'Gobierno'],
            'other' => ['icon' => '🏢', 'label' => 'Otro']
        ];

        return $industries[$this->industry_type] ?? $industries['other'];
    }

    /**
     * Relationship with orders (future implementation).
     */
    public function orders(): HasMany
    {
        // TODO: Implement CleanOrder model when order system is ready
        // For now, return empty collection
        return $this->hasMany(self::class, 'non_existent_id');
    }

    /**
     * Scope for active clients.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for high value clients.
     */
    public function scopeHighValue($query)
    {
        return $query->where('total_purchases', '>=', 10000);
    }

    /**
     * Scope for clients that need attention.
     */
    public function scopeNeedsAttention($query)
    {
        return $query->where(function($q) {
            $q->whereNull('last_purchase_date')
              ->orWhere('last_purchase_date', '<', now()->subMonths(6));
        });
    }

    /**
     * Scope by industry type.
     */
    public function scopeByIndustry($query, $industry)
    {
        return $query->where('industry_type', $industry);
    }

    /**
     * Scope by client type.
     */
    public function scopeByClientType($query, $type)
    {
        return $query->where('client_type', $type);
    }

    /**
     * Scope by risk level.
     */
    public function scopeByRiskLevel($query, $level)
    {
        return $query->where('risk_level', $level);
    }

    /**
     * Scope for ordered clients.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('company_name');
    }
}