<?php

namespace App\Filament\Resources\Teachers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TeachersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->extraImgAttributes(['class' => 'w-10 h-10 object-cover']),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->weight('semibold'),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pimpinan'       => 'warning',
                        'guru'           => 'primary',
                        'pembina_asrama' => 'success',
                        default          => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pimpinan'       => 'Pimpinan',
                        'guru'           => 'Guru',
                        'pembina_asrama' => 'Pembina Asrama',
                        default          => ucfirst($state),
                    }),

                TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'pimpinan'       => 'Pimpinan',
                        'guru'           => 'Guru',
                        'pembina_asrama' => 'Pembina Asrama',
                    ]),
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
