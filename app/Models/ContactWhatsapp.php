<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactWhatsapp extends Model
{
    protected $table = 'contact_whatsapp_numbers';

    protected $fillable = [
        'label',
        'nomor_wa',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get all active WhatsApp numbers, sorted.
     */
    public static function getActive(): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }
}
