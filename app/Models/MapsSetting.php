<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapsSetting extends Model
{
    protected $fillable = [
        'label',
        'embed_code',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get all active Maps settings, ordered.
     */
    public static function getActive(): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('is_active', true)
            ->orderBy('id')
            ->get();
    }
}
