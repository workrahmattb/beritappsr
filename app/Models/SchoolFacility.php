<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SchoolFacility extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'images',
        'description',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'images' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (SchoolFacility $facility) {
            if (! $facility->slug) {
                $facility->slug = Str::slug($facility->name);
            }
        });
    }

    /** Get the first image URL, or null */
    public function getFirstImageAttribute(): ?string
    {
        $images = $this->images ?? [];
        return count($images) > 0 ? $images[0] : null;
    }

    /** Get the image count */
    public function getImageCountAttribute(): int
    {
        return count($this->images ?? []);
    }
}
