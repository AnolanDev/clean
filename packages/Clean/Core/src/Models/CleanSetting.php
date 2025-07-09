<?php

namespace Clean\Core\Models;

use Illuminate\Database\Eloquent\Model;

class CleanSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'category',
        'description',
        'is_editable'
    ];

    protected $casts = [
        'is_editable' => 'boolean'
    ];

    /**
     * Get the setting value with proper type casting.
     */
    public function getValue()
    {
        return match ($this->type) {
            'boolean' => filter_var($this->value, FILTER_VALIDATE_BOOLEAN),
            'integer' => (int) $this->value,
            'float' => (float) $this->value,
            'json' => json_decode($this->value, true),
            default => $this->value
        };
    }

    /**
     * Set the setting value with proper type handling.
     */
    public function setValue($value)
    {
        $this->value = match ($this->type) {
            'boolean' => $value ? '1' : '0',
            'json' => json_encode($value),
            default => (string) $value
        };
    }

    /**
     * Scope by category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope for editable settings.
     */
    public function scopeEditable($query)
    {
        return $query->where('is_editable', true);
    }

    /**
     * Static method to get a setting value.
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        
        return $setting ? $setting->getValue() : $default;
    }

    /**
     * Static method to set a setting value.
     */
    public static function set($key, $value, $type = 'text')
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );

        return $setting;
    }

    /**
     * Static method to get all settings by category.
     */
    public static function getByCategory($category)
    {
        return static::where('category', $category)
            ->get()
            ->pluck('value', 'key')
            ->toArray();
    }
}