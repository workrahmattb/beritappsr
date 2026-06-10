<?php

namespace App\Filament\Resources\MapsSettings\Pages;

use App\Filament\Resources\MapsSettings\MapsSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMapsSetting extends EditRecord
{
    protected static string $resource = MapsSettingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus'),
        ];
    }
}
