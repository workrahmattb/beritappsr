<?php

namespace App\Filament\Resources\AboutSettings\Pages;

use App\Filament\Resources\AboutSettings\AboutSettingResource;
use App\Models\AboutSetting;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAboutSettings extends ListRecords
{
    protected static string $resource = AboutSettingResource::class;

    protected function getHeaderActions(): array
    {
        // Only allow creating if no record exists yet (singleton)
        if (AboutSetting::count() > 0) {
            return [];
        }

        return [
            CreateAction::make()
                ->label('Tambah Tentang'),
        ];
    }
}
