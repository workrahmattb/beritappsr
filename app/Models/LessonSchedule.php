<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonSchedule extends Model
{
    protected $fillable = [
        'day',
        'time_start',
        'time_end',
        'subject',
        'teacher',
        'class',
        'description',
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
     * Get all days in order.
     */
    public static function getDays(): array
    {
        return ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    }

    /**
     * Get the day label.
     */
    public function dayLabel(): string
    {
        return match ($this->day) {
            'Senin'   => 'Senin',
            'Selasa'  => 'Selasa',
            'Rabu'    => 'Rabu',
            'Kamis'   => 'Kamis',
            'Jumat'   => 'Jumat',
            'Sabtu'   => 'Sabtu',
            default   => $this->day,
        };
    }

    /**
     * Get active schedules grouped by day.
     */
    public static function getActiveGrouped(): \Illuminate\Support\Collection
    {
        return static::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('day');
    }
}
