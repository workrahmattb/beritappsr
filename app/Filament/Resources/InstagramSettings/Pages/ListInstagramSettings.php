<?php

namespace App\Filament\Resources\InstagramSettings\Pages;

use App\Filament\Resources\InstagramSettings\InstagramSettingResource;
use App\Models\InstagramSetting;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInstagramSettings extends ListRecords
{
    protected static string $resource = InstagramSettingResource::class;

    protected function getHeaderActions(): array
    {
        // Only allow creating if no record exists yet (singleton)
        if (InstagramSetting::count() > 0) {
            return [];
        }

        return [
            CreateAction::make()
                ->label('Tambah Pengaturan'),
        ];
    }
}
