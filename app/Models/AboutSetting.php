<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSetting extends Model
{
    protected $fillable = [
        'description',
        'visi',
        'misi',
        'sejarah',
        'image',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the active about setting (first row).
     */
    public static function getActive(): ?self
    {
        return static::where('is_active', true)->first();
    }
}
