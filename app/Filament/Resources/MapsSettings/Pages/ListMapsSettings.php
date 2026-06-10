<?php

namespace App\Filament\Resources\MapsSettings\Pages;

use App\Filament\Resources\MapsSettings\MapsSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMapsSettings extends ListRecords
{
    protected static string $resource = MapsSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Peta'),
        ];
    }
}
