<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstagramSetting extends Model
{
    protected $fillable = [
        'access_token',
        'user_id',
        'username',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the active Instagram setting (first row).
     * Uses singleton pattern — only one row is expected.
     */
    public static function getActive(): ?self
    {
        return static::where('is_active', true)->first();
    }
}
