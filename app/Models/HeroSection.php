<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image',
        'badge_text',
        'button_text',
        'button_url',
        'overlay_opacity',
        'is_active',
        'sort_order',

    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'overlay_opacity' => 'integer',
        ];
    }
}
