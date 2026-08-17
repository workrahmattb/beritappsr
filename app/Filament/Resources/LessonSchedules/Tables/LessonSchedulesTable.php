<?php

namespace App\Filament\Resources\LessonSchedules\Tables;

use App\Models\LessonSchedule;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LessonSchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('day')
                    ->label('Hari')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Senin'  => 'success',
                        'Selasa' => 'info',
                        'Rabu'   => 'warning',
                        'Kamis'  => 'primary',
                        'Jumat'  => 'danger',
                        'Sabtu'  => 'gray',
                        default  => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('time_start')
                    ->label('Mulai')
                    ->sortable(),

                TextColumn::make('time_end')
                    ->label('Selesai'),

                TextColumn::make('subject')
                    ->label('Mata Pelajaran')
                    ->searchable()
                    ->weight('semibold')
                    ->sortable(),

                TextColumn::make('teacher')
                    ->label('Guru')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('class')
                    ->label('Kelas')
                    ->searchable()
                    ->badge()
                    ->color('gray')
                    ->toggleable(),

                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->defaultSort('sort_order')
            ->filters([
                SelectFilter::make('day')
                    ->label('Hari')
                    ->options(array_combine(LessonSchedule::getDays(), LessonSchedule::getDays())),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus'),
                ]),
            ]);
    }
}
