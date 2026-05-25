<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'position',
        'photo',
        'bio',
        'sort_order',
    ];

    protected static function booted(): void
    {
        static::creating(function (Teacher $teacher) {
            if (! $teacher->slug) {
                $teacher->slug = Str::slug($teacher->name);
            }
        });
    }

    public function categoryLabel(): string
    {
        return match ($this->category) {
            'pimpinan'      => 'Pimpinan',
            'guru'          => 'Guru',
            'pembina_asrama'=> 'Pembina Asrama',
            default         => ucfirst($this->category),
        };
    }
}
